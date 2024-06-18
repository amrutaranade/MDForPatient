
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<link href="/fine-uploader/fine-uploader.min.css" rel="stylesheet">
<link href="/fine-uploader/fine-uploader-gallery.min.css" rel="stylesheet">

	
	
	
	<style>
	body {width:600px;font-family:calibri;}
	</style>
    <?php require_once("../public/fine-uploader/templates/gallery.html"); ?>
    <div id="file-drop-area"></div>
    
    <script src="/fine-uploader/fine-uploader.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Retrieve the CSRF token
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log("CSRF Token:", csrfToken); // Optional: for debugging

            // Initialize FineUploader
            var multiFileUploader = new qq.FineUploader({
                element: document.getElementById("file-drop-area"),
                request: {
                    endpoint: "/upload",
                    customHeaders: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                }
            });
        });
    </script>
</body>
</html>