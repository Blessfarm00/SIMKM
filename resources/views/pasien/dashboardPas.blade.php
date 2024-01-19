<!DOCTYPE html>
<html lang="en">

<head>
    

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Keperawatan Mandiri</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/img/klinik.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">

    <!-- =======================================================
  * Template Name: Medilab
  * Updated: Jun 23 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope"></i>
                <a href="mailto:desihudiamurni@gmail.com">desihudiamurni@gmail.com</a>
                <i class="bi bi-phone"></i>
                <a href="https://api.whatsapp.com/send?phone=083190108040">083190108040</a>
            </div>
            <div class="d-none d-lg-flex social-links align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="/dashboard-pasien">Keperawatan Mandiri</a></h1>

            <a href="/konfirmasis" class="appointment-btn scrollto"><span class="d-none d-md-inline">konfirmasi</span></a>
            <a href="/logout" class="appointment-btn scrollto"><span class="d-none d-md-inline">logout</span></a>

        </div>

    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Selamat Datang di Woocare:</h1>
                <h2> {{ auth()->check() ? auth()->user()->name : 'Pengunjung' }}</h2>

        </div>
    </section>

    <main id="main">

        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                       <hr>
                        </div>
                    </div>
                </div>

        </section><!-- End Why Us Section -->

        <section id="janji" class="janji">
            <div class="container">
                <form action="/janji" method="post">
                    @csrf
                    <div class="section-title">
                        <h2>Pembuatan Janji</h2>
                        <p>Pembuatan Janji Hanya Untuk Jasa Perawatan Luka dan Sunat</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <input type="text" name="nama" class="form-control" id="nama"
                                placeholder="Your Name" required>
                        </div>


                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input name="user_id" class="form-control" id="nama" placeholder="Your Name" required
                                value="{{ auth()->check() ? auth()->user()->name : '' }}" readonly>
                            <input type="hidden" name="user_id"
                                value="{{ auth()->check() ? auth()->user()->id : '' }}">
                        </div>


                        <div class="col-md-4 form-group mt-3 mt-md-0">
                            <input type="date" name="tanggal" class="form-control" id="tanggal"
                                placeholder="Preferred Date" required>
                        </div>

                        <script>
                            // Dapatkan elemen input tanggal
                            const tanggalInput = document.getElementById("tanggal");

                            // Atur tanggal minimum menjadi tanggal hari ini
                            const today = new Date();
                            const dd = String(today.getDate()).padStart(2, "0");
                            const mm = String(today.getMonth() + 1).padStart(2, "0"); // Januari dimulai dari 0
                            const yyyy = today.getFullYear();
                            const minDate = `${yyyy}-${mm}-${dd}`;
                            tanggalInput.setAttribute("min", minDate);
                        </script>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mt-3">
                            <input type="tel" class="form-control" name="no_hp" id="no_hp"
                                placeholder="Your Phone" required>
                        </div>



                        <div class="col-md-4 form-group mt-3">
                            <label>Department:</label><br>
                            <input type="radio" name="keterangan" id="sunat" value="Sunat">
                            <label for="sunat">Sunat</label><br>
                            <input type="radio" name="keterangan" id="perawatan" value="Perawatan Luka">
                            <label for="perawatan">Perawatan Luka</label><br>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <input type="time" name="jam" class="form-control" id="jam"
                                placeholder="Time" required min="08:00" max="21:00" oninput="validateTime()">
                            <!-- Jam dimulai dari 08:00 (8 pagi) hingga 21:00 (9 malam) -->
                        </div>

                        <script>
                            function validateTime() {
                                const selectedTime = document.getElementById('jam').value;
                                const startTime = '08:00';
                                const endTime = '21:00';

                                if (selectedTime < startTime || selectedTime > endTime) {
                                    alert('Harap pilih jam antara 8 pagi dan 9 malam (08:00 - 21:00).');
                                    document.getElementById('jam').value = ''; // Reset nilai input jika di luar rentang
                                }
                            }
                        </script>

                        <div class="col-md-4 form-group mt-3">
                            <input type="text" name="alamat" class="form-control" id="alamat"
                                placeholder="Alamat" required>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <select name="dokter_id" id="doctor" class="form-control" required @readonly(true)>
                                <option value="" disabled selected>Perawat</option>
                                <option value="1">Ishlah</option>
                                <option value="2">Desi Hudiamurni</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mt-3">
                            <input type="text" name="harga" class="form-control" id="harga"
                                placeholder="Harga" readonly>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Simpan</button>

                    </div>

                    <script>
                        // Dapatkan elemen radio button "Sunat" dan "Perawatan Luka"
                        const sunatRadio = document.getElementById("sunat");
                        const perawatanRadio = document.getElementById("perawatan");

                        // Dapatkan elemen input harga
                        const hargaInput = document.getElementById("harga");

                        // Fungsi untuk menangani perubahan radio button
                        function handleKeteranganChange() {
                            if (sunatRadio.checked) {
                                // Jika "Sunat" dipilih, atur nilai harga ke 300000
                                hargaInput.value = "300000";
                            } else if (perawatanRadio.checked) {
                                // Jika "Perawatan Luka" dipilih, atur nilai harga ke 150000
                                hargaInput.value = "150000";
                            } else {
                                // Jika pilihan lain atau tidak ada yang dipilih, kosongkan nilai harga
                                hargaInput.value = "";
                            }
                        }

                        // Tambahkan event listener untuk radio button
                        sunatRadio.addEventListener("change", handleKeteranganChange);
                        perawatanRadio.addEventListener("change", handleKeteranganChange);

                        // Panggil fungsi saat halaman dimuat untuk menginisialisasi nilai harga
                        handleKeteranganChange();
                    </script>

            </div>

            </form>
            </div>
        </section>





    </main>
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Woocare</h3>
                        <p>
                            Sumanik<br>
                            jln.depan balai<br>
                            Salimpaung. Sumatra Barat. indonesia<br><br>
                            <strong>Phone:</strong>082391429322<br>
                            <strong>Email:</strong>woocare@gmail.com<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Medilab</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/medilab-free-medical-bootstrap-theme/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sunatRadio = document.getElementById('sunat');
            const perawatanRadio = document.getElementById('perawatan');
            const doctorSelect = document.getElementById('doctor');

            sunatRadio.addEventListener('change', function() {
                if (sunatRadio.checked) {
                    setDoctorValue("1");
                }
            });

            perawatanRadio.addEventListener('change', function() {
                if (perawatanRadio.checked) {
                    setDoctorValue("2");
                }
            });

            function setDoctorValue(doctorId) {
                doctorSelect.value = doctorId;
                // Panggil fungsi untuk mengirim data ke server
                sendDataToServer(doctorId);
            }

            function sendDataToServer(doctorId) {
                // Menggunakan AJAX atau library lainnya untuk mengirim data ke server
                // Contoh dengan menggunakan fetch API
                fetch('/save-doctor', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            dokter_id: doctorId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data saved:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    </script>



</body>

</html>

@include('sweetalert::alert')
