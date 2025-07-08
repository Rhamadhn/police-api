if (window.location.pathname.includes('/panel-control/locations')) {
    let createMap, createMarker, editMap, editMarker;

    document.addEventListener("DOMContentLoaded", async function () {
        try {
            const token = decodeURIComponent(getCookie('token'));
            if (!token) {
                console.warn("Token tidak ditemukan di cookie.");
                window.location.href = '/';
                return;
            }

            const response = await axios.get('/api/panel-control/locations', {
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                withCredentials: true
            });

            displayLocations(response.data.data);
        } catch (error) {
            console.error("Gagal memuat data lokasi:", error);
            showErrorToast("Gagal memuat data lokasi.");
            if (error.response && (error.response.status === 401 || error.response.status === 403)) {
                window.location.href = '/';
            }
        }

        document.getElementById("addLocationBtn").addEventListener("click", function () {
            clearCreateFormErrors();
            document.getElementById("createLocationForm").reset();

            setTimeout(() => {
                initCreateLocationMap();
                createMap.invalidateSize();
            }, 500);
        });

        document.getElementById("createLocationForm").addEventListener("submit", addLocation);
        document.getElementById("editLocationForm").addEventListener("submit", updateLocation);
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
        document.getElementById("createDescriptionError").textContent = "";
        document.getElementById("createLatitudeError").textContent = "";
        document.getElementById("createLongitudeError").textContent = "";
    }

    function clearEditFormErrors() {
        document.getElementById("editNameError").textContent = "";
        document.getElementById("editDescriptionError").textContent = "";
        document.getElementById("editLatitudeError").textContent = "";
        document.getElementById("editLongitudeError").textContent = "";
    }

    async function addLocation(event) {
        event.preventDefault();
        clearCreateFormErrors();

        const token = decodeURIComponent(getCookie('token'));
        const payload = {
            name: document.getElementById("createName").value.trim(),
            description: document.getElementById("createDescription").value.trim(),
            latitude: document.getElementById("createLatitude").value.trim(),
            longitude: document.getElementById("createLongitude").value.trim(),
        };

        try {
            const response = await axios.post('/api/panel-control/locations', payload, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                withCredentials: true
            });

            $('#addLocationModal').modal('hide');
            Swal.fire({ icon: 'success', toast: true, title: response.data.message, position: 'top-end', timer: 3000, showConfirmButton: false });
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response?.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("createNameError").textContent = errors.name[0];
                if (errors.description) document.getElementById("createDescriptionError").textContent = errors.description[0];
                if (errors.latitude) document.getElementById("createLatitudeError").textContent = errors.latitude[0];
                if (errors.longitude) document.getElementById("createLongitudeError").textContent = errors.longitude[0];
            } else {
                showErrorToast(error.response?.data?.message || "Gagal menambahkan lokasi.");
            }
        }
    }

    function displayLocations(data) {
        const tableBody = document.getElementById("locationsTableBody");
        tableBody.innerHTML = "";

        const map = L.map('locationMap').setView([-2.5489, 118.0149], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
        }).addTo(map);

        if (!data.length) {
            tableBody.innerHTML = `<tr><td colspan="6" class="text-center">Data tidak tersedia</td></tr>`;
            return;
        }

        window.locationData = data;

        data.forEach((item, index) => {
            L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup(`<strong>${item.name}</strong><br>${item.description || '-'}`);

            const row = document.createElement('tr');
            row.innerHTML = `
                <th scope="row">${index + 1}</th>
                <td>${item.name}</td>
                <td>${item.description || '-'}</td>
                <td>${item.latitude}</td>
                <td>${item.longitude}</td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editLocationModal"
                        onclick="showEditLocationModal(${item.id}, ${index})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="confirmDeleteLocation(${item.id})">Hapus</button>
                </td>
            `;
            tableBody.appendChild(row);
        });

        $('#locationsTable').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                infoEmpty: "Tidak ada data tersedia",
                paginate: {
                    first: "Pertama", last: "Terakhir", next: "→", previous: "←"
                },
            }
        });
    }

    window.showEditLocationModal = function (id, index) {
        clearEditFormErrors();
        const item = window.locationData[index];

        document.getElementById("editLocationId").value = id;
        document.getElementById("editName").value = item.name || '';
        document.getElementById("editDescription").value = item.description || '';
        document.getElementById("editLatitude").value = item.latitude || '';
        document.getElementById("editLongitude").value = item.longitude || '';

        setTimeout(() => {
            const lat = parseFloat(item.latitude) || -2.5489;
            const lng = parseFloat(item.longitude) || 118.0149;
            initEditLocationMap(lat, lng);
            editMap.invalidateSize();
        }, 500);
    }

    async function updateLocation(event) {
        event.preventDefault();
        clearEditFormErrors();

        const id = document.getElementById("editLocationId").value;
        const token = decodeURIComponent(getCookie('token'));

        const payload = {
            name: document.getElementById("editName").value.trim(),
            description: document.getElementById("editDescription").value.trim(),
            latitude: document.getElementById("editLatitude").value.trim(),
            longitude: document.getElementById("editLongitude").value.trim(),
        };

        try {
            const response = await axios.put(`/api/panel-control/locations/${id}`, payload, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                },
                withCredentials: true
            });

            $('#editLocationModal').modal('hide');
            Swal.fire({ icon: 'success', toast: true, title: response.data.message, position: 'top-end', timer: 3000, showConfirmButton: false });
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            if (error.response?.status === 422) {
                const errors = error.response.data.errors;
                if (errors.name) document.getElementById("editNameError").textContent = errors.name[0];
                if (errors.description) document.getElementById("editDescriptionError").textContent = errors.description[0];
                if (errors.latitude) document.getElementById("editLatitudeError").textContent = errors.latitude[0];
                if (errors.longitude) document.getElementById("editLongitudeError").textContent = errors.longitude[0];
            } else {
                showErrorToast(error.response?.data?.message || "Gagal memperbarui lokasi.");
            }
        }
    }

    window.confirmDeleteLocation = async function (id) {
        const result = await Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data ini tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        });

        if (result.isConfirmed) {
            deleteLocation(id);
        }
    }

    async function deleteLocation(id) {
        try {
            const token = decodeURIComponent(getCookie('token'));
            const response = await axios.delete(`/api/panel-control/locations/${id}`, {
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
                title: response.data.message || 'Lokasi berhasil dihapus.'
            });

            document.getElementById('locationsTableBody').innerHTML = '';
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            const errorMessage = error.response?.data?.message || "Terjadi kesalahan saat menghapus lokasi.";
            showErrorToast(errorMessage);
        }
    }

    function initCreateLocationMap() {
        if (createMap) createMap.remove();

        createMap = L.map('createLocationMap').setView([-2.5489, 118.0149], 5);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(createMap);

        createMap.on('click', function (e) {
            const { lat, lng } = e.latlng;
            if (createMarker) createMap.removeLayer(createMarker);
            createMarker = L.marker([lat, lng]).addTo(createMap);
            document.getElementById('createLatitude').value = lat.toFixed(6);
            document.getElementById('createLongitude').value = lng.toFixed(6);
        });
    }

    function initEditLocationMap(lat, lng) {
        if (editMap) editMap.remove();

        editMap = L.map('editLocationMap').setView([lat, lng], 10);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(editMap);

        editMarker = L.marker([lat, lng]).addTo(editMap);

        editMap.on('click', function (e) {
            const { lat, lng } = e.latlng;
            if (editMarker) editMap.removeLayer(editMarker);
            editMarker = L.marker([lat, lng]).addTo(editMap);
            document.getElementById('editLatitude').value = lat.toFixed(6);
            document.getElementById('editLongitude').value = lng.toFixed(6);
        });
    }
}
