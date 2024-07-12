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
    <link href="/fine-uploader/fine-uploader-new.css" rel="stylesheet">
    <link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' 
         rel='stylesheet'>

    
    <style>
        .content-wrapper{
            background:#1bcfb4
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

        body {
            background-color: #00C4CC;
            font-family: Arial, sans-serif;
        }
        .otp_container{
            max-width: 80rem !important;
        }
        .container, .otp_container {
            
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 2px solid #ffffff;
            max-width: 120rem !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dottedDiv{
            width:118rem;
            padding: 20px;
            background-color: #ffffff;
            border: 2px dashed #00C4CC;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .left {
            width: 35%;
        }
        .right {
            width: 55%;
        }
        .left {
            text-align: center;
        }

        .custom-box {
            border: 2px dashed #00CED1;
            padding: 20px;
            background-color: white;
        }
        .custom-button {
            background-color: #00CED1;
            border: none;
            color: black;
        }
        .custom-container {
            background-color: #00CED1;
            padding: 20px;
        }
        #case-form{
            width:100%
        }
    
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
</head>
<body>
    <div class="container-scroller">
        <!-- partial:/dist/partials/_navbar.html -->
        @include('headerLogin')
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    <!-- <script src="{{ mix('js/validation.js') }}"></script> -->
    <script src="/fine-uploader/jquery.fine-uploader.js"></script>
    <script src=
"https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
</script>
    <!-- End custom js for this page -->
    <script>
        $(document).on('click', '.btnDiscardRequest', function() {
            if (confirm("You will lose filled data. Are you sure you want to discard the application?")) {
                window.location.href = "{{ route('discard-application') }}";
            }
        });
        $(document).on('click', '.register', function() {            
            window.location.href = "{{ route('home') }}";        
        });
    </script>
</body>
</html>