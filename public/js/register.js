document.addEventListener("DOMContentLoaded", function (event) {
    const registerForm = document.getElementById('registerForm');


    registerForm.addEventListener("submit", async function (event) {
        event.preventDefault();

        //ambil nilai dari input field
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        //tampilan error
        const nameError = document.getElementById('nameError');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        // Hapus pesan error sebelumnya
        if (nameError) nameError.textContent = "";
        if (emailError) emailError.textContent = "";
        if (passwordError) passwordError.textContent = "";

        try {
            const response = await axios.post("/api/register", {
                name: name,
                email: email,
                password: password
            }, {
                headers: {
                    "Content-Type": "application/json"
                },
                withCredentials: true
            });

            Swal.fire({
                icon: 'success',
                title: response.data.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });

            setTimeout(() => {
                window.location.href = "/";
            }, 2000);
        } catch (error) {
            if (error.response) {
                const {
                    status,
                    data
                } = error.response;

                if (status === 422 && data.errors) {
                    // Memeriksa apakah data.errors adalah objek
                    if (typeof data.errors === "object") {
                        // Iterasi setiap field dan menampilkan error message
                        Object.keys(data.errors).forEach((key) => {
                            const errorElement = document.getElementById(`${key}Error`);
                            if (errorElement) {
                                const messages = data.errors[key];
                                // Menampilkan pesan kesalahan jika ada
                                errorElement.textContent = messages ? messages.join(', ') : '';
                            }
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan',
                        text: data.message || 'Terjadi kesalahan, silakan coba lagi.',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Server tidak merespon',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
            }
        }

    });
});
