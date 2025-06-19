if (window.location.pathname.includes('/panel-control/officers')) {
    document.addEventListener("DOMContentLoaded", async function () {
        try {
            const token = decodeURIComponent(getCookie('token'));

            if (!token) {
                console.warn("Token tidak ditemukan di cookie.");
                window.location.href = '/';
                return;
            }

            const response = await axios.get('/api/panel-control/officers', {
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                withCredentials: true
            });

            displayOfficers(response.data.data);
        } catch (error) {
            console.error("Gagal memuat data officer:", error);

            let errorMessage = "Terjadi kesalahan saat memuat data.";
            if (error.response) {
                errorMessage = error.response.data.message || errorMessage;
            }

            showErrorToast(errorMessage);

            if (error.response && (error.response.status === 401 || error.response.status === 403)) {
                window.location.href = '/';
            }
        }

        document.getElementById("addOfficerBtn").addEventListener("click", function () {
            clearCreateFormErrors();
            document.getElementById("createOfficerForm").reset();
        });

        document.getElementById("createOfficerForm").addEventListener("submit", addOfficer);
        document.getElementById("editOfficerForm").addEventListener("submit", updateOfficer);
    });

    function showErrorToast(message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            icon: 'error',
            title: message,
        });
    }

    function clearCreateFormErrors() {
        document.getElementById("createNameError").textContent = "";
        document.getElementById("createBadgeError").textContent = "";
        document.getElementById("createRankError").textContent = "";
        document.getElementById("createAreaError").textContent = "";
    }

    function clearEditFormErrors() {
        document.getElementById("editNameError").textContent = "";
        document.getElementById("editBadgeError").textContent = "";
        document.getElementById("editRankError").textContent = "";
        document.getElementById("editAreaError").textContent = "";
    }

    async function addOfficer(event) {
        event.preventDefault();
        clearCreateFormErrors();

        const token = decodeURIComponent(getCookie('token'));

        const payload = {
            name: document.getElementById("createName").value.trim(),
            badge_number: document.getElementById("createBadge").value.trim(),
            rank: document.getElementById("createRank").value.trim(),
            assigned_area: document.getElementById("createArea").value.trim(),
        };

        try {
            const response = await axios.post('/api/panel-control/officers', payload, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                withCredentials: true
            });

            $('#addOfficerModal').modal('hide');

            setTimeout(() => Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: 'success',
                title: response.data.message
            }), 300);

            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("createNameError").textContent = errors.name[0];
                if (errors.badge_number) document.getElementById("createBadgeError").textContent = errors.badge_number[0];
                if (errors.rank) document.getElementById("createRankError").textContent = errors.rank[0];
                if (errors.assigned_area) document.getElementById("createAreaError").textContent = errors.assigned_area[0];
            } else {
                showErrorToast(error.response?.data?.message || "Terjadi kesalahan saat menambahkan petugas.");
            }
        }
    }

    function displayOfficers(data) {
        const tableBody = document.getElementById("officersTableBody");
        tableBody.innerHTML = "";

        if (data.length === 0) {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center">Data tidak tersedia</td></tr>`;
            return;
        }

        window.officerData = data;

        data.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${item.name}</td>
                <td>${item.badge_number}</td>
                <td>${item.rank}</td>
                <td>${item.assigned_area}</td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#editOfficerModal" onclick="showEditOfficerModal(${item.id}, ${index})">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteOfficer(${item.id})">Delete</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        $('#officersTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya",
                },
            }
        });
    }

    window.showEditOfficerModal = function (id, index) {
        clearEditFormErrors();
        const item = window.officerData[index];

        document.getElementById("editOfficerId").value = id;
        document.getElementById("editName").value = item.name || '';
        document.getElementById("editBadge").value = item.badge_number || '';
        document.getElementById("editRank").value = item.rank || '';
        document.getElementById("editArea").value = item.assigned_area || '';
    }

    async function updateOfficer(event) {
        event.preventDefault();
        clearEditFormErrors();

        const id = document.getElementById("editOfficerId").value;
        const payload = {
            name: document.getElementById("editName").value.trim(),
            badge_number: document.getElementById("editBadge").value.trim(),
            rank: document.getElementById("editRank").value.trim(),
            assigned_area: document.getElementById("editArea").value.trim(),
        };

        const token = decodeURIComponent(getCookie('token'));

        try {
            const response = await axios.put(`/api/panel-control/officers/${id}`, payload, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                withCredentials: true
            });

            $('#editOfficerModal').modal('hide');

            setTimeout(() => Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: 'success',
                title: response.data.message
            }), 300);

            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response && error.response.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("editNameError").textContent = errors.name[0];
                if (errors.badge_number) document.getElementById("editBadgeError").textContent = errors.badge_number[0];
                if (errors.rank) document.getElementById("editRankError").textContent = errors.rank[0];
                if (errors.assigned_area) document.getElementById("editAreaError").textContent = errors.assigned_area[0];
            } else {
                showErrorToast(error.response?.data?.message || "Terjadi kesalahan saat memperbarui data petugas.");
            }
        }
    }

    window.confirmDeleteOfficer = async function (id) {
        const result = await Swal.fire({
            title: 'Anda yakin?',
            text: "Data tidak dapat dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        });

        if (result.isConfirmed) {
            deleteOfficer(id);
        }
    }

    async function deleteOfficer(id) {
        try {
            const token = decodeURIComponent(getCookie('token'));
            const response = await axios.delete(`/api/panel-control/officers/${id}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                withCredentials: true
            });

            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: 'success',
                title: response.data.message || 'Data berhasil dihapus.'
            });

            document.getElementById('officersTableBody').innerHTML = '';
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            const errorMessage = error.response?.data?.message || "Terjadi kesalahan saat menghapus data.";
            showErrorToast(errorMessage);
        }
    }
}
