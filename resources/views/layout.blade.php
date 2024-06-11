<!DOCTYPE html>
<html lang="en">
  <head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MD For Patient</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/dist/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/dist/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/dist/assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/dist/assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="/dist/assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/dist/assets/css/style.css">
    <link rel="stylesheet" href="/dist/assets/css/stepwise.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/dist/assets/images/favicon.png" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:/dist/partials/_navbar.html -->
      @include('header')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper align-items-center auth">
          <!-- partial:/dist/partials/_sidebar.html -->
          <!--@include('sidebar')-->
          <!-- partial -->
          @yield("content")
          <!-- main-panel ends -->
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/dist/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/dist/assets/vendors/select2/select2.min.js"></script>
    <script src="/dist/assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/dist/assets/js/off-canvas.js"></script>
    <script src="/dist/assets/js/misc.js"></script>
    <script src="/dist/assets/js/settings.js"></script>
    <script src="/dist/assets/js/todolist.js"></script>
    <script src="/dist/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="/dist/assets/js/file-upload.js"></script>
    <script src="/dist/assets/js/typeahead.js"></script>
    <script src="/dist/assets/js/select2.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/patient.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>