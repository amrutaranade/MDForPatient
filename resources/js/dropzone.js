    Dropzone.options.fileUpload = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.pdf,.docx,.xlsx,.zip",
        autoProcessQueue: false,
        parallelUploads: 50, // Upload files one at a time
        addRemoveLinks: true, // Enable the built-in remove links
        totalMaxFilesize: 50, 
        init: function() {
            var myDropzone = this;

            // Add event listener to the Confirm Upload button
            document.getElementById("confirm-upload").addEventListener("click", function() {
                myDropzone.processQueue(); // Trigger file upload on button click
            });

            // Handle file removal
            this.on("addedfile", function(file) {
                // Create the remove button
                var removeButton = Dropzone.createElement("<button class='btn btn-danger btn-sm mt-2'>Delete</button>");
                
                // Listen to the click event
                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Remove the file preview and the file itself from the Dropzone instance
                    myDropzone.removeFile(file);
                });

                // Append the remove button to the file preview element
                file.previewElement.appendChild(removeButton);
            });

            // Handling the queue complete event
            this.on("queuecomplete", function() {
                console.log("All files have been uploaded.");
            });

            // Handling the success event
            this.on("success", function(file, response) {
                console.log("success", response);
                console.log('file->', file);
            });

            // Handling the error event
            this.on("error", function(file, response) {
                console.error("error", response);
                console.error('file->', file);
            });
        }
    };
