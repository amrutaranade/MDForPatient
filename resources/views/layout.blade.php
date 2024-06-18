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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dist/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/dist/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/dist/assets/vendors/font-awesome/css/font-awesome.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
   
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="/dist/assets/css/style.css">
    <link rel="stylesheet" href="/dist/assets/css/stepwise.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="/dist/assets/images/favicon.png" />
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
        #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
    </style>
    <link href="/fine-uploader/fine-uploader-new.css" rel="stylesheet">
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
    
   
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ mix('js/validation.js') }}"></script>
    <!-- End custom js for this page -->
     <script>
      $(document).on('click', '.btnDiscardRequest', function() {
        if (confirm("You will loose filled data. Are you sure you want to discard the application? ")) {
          window.location.href = "{{ route('discard-application') }}";
        }
      });
     </script>

  </body>
</html>