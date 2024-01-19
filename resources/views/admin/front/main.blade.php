@include('sweetalert::alert')


<!DOCTYPE html>
<html lang="en">

@include('admin.front.header')

<body>


  <main id="main" class="main">


    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif

    {{-- <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title --> --}}

    <div class="container">
        @yield('container')
    </div>


  </main><!-- End #main -->

  @include('admin.layouts.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/vendor/chart.js/chart.min.js"></script>
  <script src="/vendor/echarts/echarts.min.js"></script>
  <script src="/vendor/quill/quill.min.js"></script>
  <script src="/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/vendor/tinymce/tinymce.min.js"></script>
  <script src="/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="{{ asset('font/css/all.min.css')}}">
  <script>
      
//       $('.tombol-status').on('click', function(e) {
//         e.preventDefault()
      
//         const href = $(this).attr('href');

//                   const swalWithBootstrapButtons = Swal.mixin({
//             customClass: {
//               confirmButton: 'btn btn-success',
//               cancelButton: 'btn btn-danger'
//             },
//             buttonsStyling: false
//           })

//           swalWithBootstrapButtons.fire({
//             title: 'Are you sure?',
//             text: "You won't be able to revert this!",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonText: 'Yes, delete it!',
//             cancelButtonText: 'No, cancel!',
//             reverseButtons: true
//           }).then((result) => {
//             if (result.isConfirmed) {
//               document.location.href = href;
//             } else if (
//               /* Read more about handling dismissals below */
//               result.dismiss === Swal.DismissReason.cancel
//             ) {
//               swalWithBootstrapButtons.fire(
//                 'Cancelled',
//                 'Your imaginary file is safe :)',
//                 'error'
//               )
//             }
// })
      
      
//       });

          
  </script>

</body>

</html>