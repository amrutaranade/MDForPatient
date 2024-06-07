@extends("layout")
@section("content")
    <div class="container">
        <h2>File Upload</h2>
        <form action="{{ url('/upload') }}" class="dropzone" id="file-upload" enctype="multipart/form-data">
            @csrf
        </form>
    </div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    Dropzone.options.fileUpload = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.pdf,.docx,.xlsx",
        init: function() {
            this.on("success", function(file, response) {
                console.log(response);
                console.log('file->',file)
            });
        }
    };
</script>
@endsection
