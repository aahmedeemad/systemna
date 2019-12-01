<html>
    <head>
       <script src="js/jquery-3.4.1.min.js"></script>
        <script>
            function uploadFile(){
                var input = document.getElementById("file");
                file = input.files[0];
                if(file != undefined){
                    formData= new FormData();
                    if(!!file.type.match(/.jpeg/)){
                        formData.append("image", file);
                        $.ajax({
                            url: "uploadUserImage.php",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data){
                                alert('success');
                            }
                        });
                    }else{
                        alert('Not a valid image!');
                    }
                }else{
                    alert('Input something!');
                }
            }
        </script>
    </head>
    <body>
        <input type="file" id="file" accept=".jpeg"/>
        <button onclick="uploadFile();">Upload</button>
    </body>
</html>