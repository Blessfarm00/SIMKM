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

  <style>
        /* Gaya CSS untuk membuat gambar bulat */
        .rounded-circle {
            border-radius: 50%;
            overflow: hidden;
            width: 120px;
            height: 120px;
            margin-right: 20px;
        }

        .rounded-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Gaya CSS eksisting Anda dapat tetap berada di sini */
        /* Misalnya: */
        body {
            font-family: 'Arial', sans-serif;
        }

        /* ... (Tambahkan gaya CSS lainnya jika diperlukan) ... */
    </style>

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

            <h1 class="logo me-auto"><a href="/halaman-awal">Keperawatan Mandiri</a></h1>
            {{-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a> --}}

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#services">Services</a></li>
                    <li><a class="nav-link scrollto" href="#departments">Departments</a></li>
                    <li><a class="nav-link scrollto" href="#doctors">Doctors</a></li>
                    <li><a class="nav-link scrollto" href="#janji">Janji</a></li>
                    <li class="nav-item">
                    </li><!-- End Profile Page Nav -->
                </ul>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="/login" class="appointment-btn scrollto"><span class="d-none d-md-inline">Login</span></a>

        </div>

    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>SIMKM Woocare</h1>
        </div>
    </section>

    <main id="main">

        <!-- ======= Why Us Section ======= -->

        <section id="why-us" class="why-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Ambil Nomor Antrian Disini</h3>
                            <div class="text-center">
                                <a href="/antrian" id="ambilAntrianBtn" class="more-btn"
                                    onclick="ambilNomorAntrian()">Ambil no Antrian<i
                                        class="bx bx-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-receipt"></i>
                                        <h4>Telah Berdiri selama lebih dari 10 Tahun!!</h4>
                                        <p>Keperawatan Mandiri Woocare sudah berdiri selama lebih dari 10 tahun dan
                                            Sudah Mendapatakan
                                            Beberapa Sertifikat yang SAH!!
                                        </p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-cube-alt"></i>
                                        <h4>Memiliki Perawat yang Sudah Berpengalaman</h4>
                                        <p>Perawat kami sudah Pasti sudah berpengalaman dan memiliki banyak sertifikat
                                            yang sah</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-images"></i>
                                        <h4>Kami Menyediakan Home Visit Khusus untuk Pasien Sunat dan Perawatan Luka
                                        </h4>
                                        <p>Khusus Pasien Sunat dan Perawatan Luka Kami bisa Melakukan Home Visit</p>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End Why Us Section -->

        <!-- ======= Departments Section ======= -->
        <section id="departments" class="departments">
            <div class="container">

                <div class="section-title">
                    <h2>Departments</h2>
                    <p>Selamat datang di Woocare ! Kami bangga memiliki layanan unggulan dalam bidang kesehatan. Dengan
                        penuh dedikasi, kami menawarkan beragam pelayanan kesehatan yang mencakup Departemen Poli Umum,
                        Sunat, dan Perawatan Luka Modern. Tim profesional kami siap memberikan perawatan terbaik untuk
                        menjaga kesehatan Anda. Keunggulan pelayanan dan teknologi moderen kami akan memberikan
                        pengalaman perawatan yang optimal. Terima kasih atas kepercayaan Anda kepada kami.</p>
                </div>

                <div class="row gy-4">
                    <div class="col-lg-3">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">Poli Umum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Perawatan Luka</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Sunat Modern</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <div class="row gy-4">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Poli Umum</h3>
                                        <p class="fst-italic"></p>
                                        <p>Poli Umum menangani berbagai jenis keluhan kesehatan, seperti demam, batuk,
                                            pilek, sakit kepala, gangguan pencernaan ringan, serta pemeriksaan kesehatan
                                            umum. Tujuan dari Poli Umum adalah memberikan perawatan awal, diagnosis
                                            sederhana, dan pengobatan dasar untuk masalah kesehatan yang umum terjadi.
                                        </p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-2">
                                <div class="row gy-4">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Perawatan Luka</h3>
                                        <p class="fst-italic"></p>
                                        <p>Perawatan luka modern adalah pendekatan medis yang canggih dalam mengelola
                                            luka dengan fokus pada penyembuhan yang optimal dan pencegahan komplikasi
                                            serius. Salah satu metode perawatan luka modern adalah teknik yang
                                            mengangkat jaringan mati di lokasi luka, yang dapat secara signifikan
                                            mengurangi risiko amputasi.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab-3">
                                <div class="row gy-4">
                                    <div class="col-lg-8 details order-2 order-lg-1">
                                        <h3>Sunat</h3>
                                        <p class="fst-italic"></p>
                                        <p>Kami memiliki layanan sunat yang menawarkan tiga teknik yang berbeda, yaitu
                                            teknik gunting, teknik laser, dan teknik klamp. Teknik gunting melibatkan
                                            pengangkatan kulit yang berlebih dengan menggunakan gunting medis khusus.
                                            Teknik laser menggunakan energi laser untuk memotong kulit secara akurat.
                                            Sedangkan teknik klamp melibatkan penggunaan klamp khusus untuk mengikat dan
                                            mengangkat kulit yang berlebih. Setiap teknik memiliki kelebihan dan metode
                                            penanganan yang berbeda, dan kami siap memberikan informasi dan rekomendasi
                                            yang tepat sesuai dengan kebutuhan dan preferensi Anda.</p>
                                    </div>
                                    <div class="col-lg-4 text-center order-1 order-lg-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Departments Section -->

        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors">
            <div class="container">

                <div class="section-title">
                    <h2>Perawat</h2>
                    <p>Berikut Perawat Professional kami yang akan menangani anda</p>
                </div>

                <div class="row">

                    <div class="col-lg-6">
                        <div class="member d-flex align-items-start">
                            <div class="pic"><img src="assets/img/doctors/doctors-1.jpg" class="img-fluid"
                                    alt=""></div>
                            <div class="member-info">
                                <h4>ishlah S.Kep</h4>
                                <span>Khsusus Melakukan Sunat</span>
                                <p>Sudah Bersertifikat yang berskala nasional</p>
                                <p>1. Sertifikat Basic Hipnosis resmi IBH berlaku Nasional
                                <p>2. Sertifikat Hipnokhitan</p>
                                <p>3. Sertifikat Pelatihan Khitan Modern</p>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div class="member d-flex align-items-start">
                            <div class="pic rounded-circle overflow-hidden">
                                <img src="assets/img/doctors/doctors-5.jpg" class="img-fluid" alt="">
                            </div>

                            <div class="member-info">
                                <h4>Desi Hudiamurni S.kep</h4>
                                <span>Perawatan Luka Modern</span>
                                <p>Sudah Bersertifikat yang berskala nasional</p>
                                <p>1. PELATIHAN PERAWATAN LUKA MODERN / CWCCA (Certified Wound Care Clinician Associate)
                                <p>2. Sertifikat Profesi</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Doctors Section -->





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
