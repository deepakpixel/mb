
            <?php 
            require_once "../../../../resources/config/db.php";
            session_start();
            if (!((isset($_SESSION['loggedin'])) && $_SESSION['loggedin']=="tc-candidate"))
            header("location: index.php");
           ?>
<html lang=en>
    <head><title>Techchef Round 2</title>
    <script src="../alert.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css">
<link rel="stylesheet" href="../test-style.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- <script src="../test-functions.js"></script> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<body>


            <?php
// $id=$_SESSION['id'];
// $user=mysqli_query($conn,"SELECT * FROM registrations WHERE id='$id" );
// $user=mysqli_fetch_array($user);
// $_SESSION['isstarted']=$user['isstarted'];
// $_sess
            $settings=file_get_contents("../../config/settings.json");
            $settings= json_decode($settings,true); //converts json to array


            // $section1=mysqli_query($conn,"SELECT * FROM questions WHERE section=1");
            // $section2=mysqli_query($conn,"SELECT * FROM questions WHERE section=2");
            // $section3=mysqli_query($conn,"SELECT * FROM questions WHERE section=3");
            // $total_section_1_questions=mysqli_num_rows($section1);
            // $total_section_2_questions=mysqli_num_rows($section2);
            // $total_section_3_questions=mysqli_num_rows($section3);


            // $total_time=$settings['total-test-time'];

    //   if((isset($_SESSION['isstarted']) && $_SESSION['isstarted']==1))
    //         {
    //             $_SESSION['remaining-time']=$_SESSION['end']-time();
    //             $total_time=$_SESSION['remaining-time']/60;
    //         }



            // $todo_total_questions=$settings['total-questions'];
            // $todo_section_1_questions=$settings['questions-section-1'];
            // $todo_section_2_questions=$settings['questions-section-2'];
            // $todo_section_3_questions=$settings['questions-section-3'];



           

// echo '<br>'.$total_section_3_questions;
// $candidate_name="Deepak";
$candidate_name=$_SESSION['name'];
// echo $row;
?>







    <div class="header">
        <div id="hello-user">Hello <?php echo $candidate_name?></div>
        <div id="time-details">
            <span id="time-left"></span> </div>
    </div>
   


<div class="alert alert-info" style="border-radius:0px;">
Solution can be in form of image, document or video.
</div>
<div class="container">
    <form id="uploadForm" enctype="multipart/form-data">
        <input name="id" type="text" value="<?php echo $_SESSION['id'] ?>" hidden>
        <input name="username" type="text" value="<?php echo $_SESSION['username'] ?>" hidden>
  


                                    
                        <div class="file-upload">
                        <div class="file-select">
                            <div class="file-select-button" id="fileName">Choose File</div>
                            <div class="file-select-name" id="noFile">No file chosen...</div> 
                            <input type="file" name="file" id="chooseFile">

                            <!-- <input type="file" name="file" id="fileInput"> -->

                        </div>
                        </div>
            <!-- <div class="upload-btn-wrapper">
            <label>Choose File:</label>
            <button class="btn">Upload solution</button>
            <input type="file" name="file" id="fileInput">
            </div> -->
            <!-- <label for="fileInput" class="btn"> Choose File:</label> -->
            <!-- <input type="file" name="file" id="fileInput"> -->

        <div class="progress" style="margin-top:10px; margin-bottom:10px;">
            <div class="progress-bar"></div>
        </div>
        <!-- <label>Choose File:</label> -->
        <input type="submit" name="submit" value="UPLOAD" class="btn btn-info">
    </form>


<!-- <div id="uploadStatus"></div> -->



<!-- <div class="your-uploads alert alert-secondary" id="your-uploads"> -->

<?php
$i=0;
$files = scandir('../../uploads/');
$firstpart=$_SESSION['id'].'-'.$_SESSION['username'].'-';
foreach($files as $file) {
    
    if(strpos($file,$firstpart)===0)
    {
  $file=str_replace($firstpart,'',$file);
  if($i==0)
   { echo '<div style="margin-bottom:12px;">Your uploads:</div>';
    $i++;}
  echo '<div class="alert alert-success">'.$file.'</div>';
//   var_dump($file);
    }
}
?>

<!-- </div> -->
</div>



<!-- <button onclick="window.location.href='ex.php'">LOGOUT</button> -->




</body>


</html>


<!-- <script>
swal.fire("READ CAREFULLY","In detail how to submit")
</script> -->






<script>
$(document).ready(function(){
    // File upload via Ajax
    $("#uploadForm").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        // var percentComplete = (Math.floor((evt.loaded / evt.total) * 100));
                        // $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").width('100%');
                        $(".progress-bar").html('Uploading...');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: 'upload.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
                // $('#uploadStatus').html('<img src="images/loading.gif"/>');
            },
            error:function(){
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
            },
            success: function(resp){
                if(resp == 'ok'){
                    $('#uploadForm')[0].reset();
                    swal.fire("Uploaded!","File successfully uploaded","success").then(() => {
                    window.location.href = "test.php";
                    });
                    $(".progress-bar").width('0%');
                    $(".file-upload").removeClass('active');
                    $("#noFile").text("No file chosen..."); 
                    // $('#uploadStatus').html('<p style="color:#28A74B;">File has uploaded successfully!</p>');
                }else if(resp == 'err'){
                    // $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                    swal.fire("Choose a file!","Please select a file to upload","warning");
                    $(".progress-bar").width('0%');

                }else if(resp == 'largefile'){
                    // $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                    swal.fire("Large file size!","Max upload size is 20MB","warning");
                    $(".progress-bar").width('0%');

                }else if(resp == 'duplicate'){
                    // $('#uploadStatus').html('<p style="color:#EA4335;">Please select a valid file to upload.</p>');
                    swal.fire("File already present!","File is already uploaded","warning");
                    $(".progress-bar").width('0%');
                   

                }
            }
        });
    });
	
    // File type validation
    // $("#fileInput").change(function(){
    //     var allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    //     var file = this.files[0];
    //     var fileType = file.type;
    //     if(!allowedTypes.includes(fileType)){
    //         alert('Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).');
    //         $("#fileInput").val('');
    //         return false;
    //     }
    // });
});


$('#chooseFile').bind('change', function () {
  var filename = $("#chooseFile").val();
  if (/^\s*$/.test(filename)) {
    $(".file-upload").removeClass('active');
    $("#noFile").text("No file chosen..."); 
  }
  else {
    $(".file-upload").addClass('active');
    $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
  }
});


</script>






<style>
/* .upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
}

.btn {
  border: 2px solid gray;
  color: gray;
  background-color: white;
  padding: 8px 20px;
  border-radius: 8px;
  font-size: 20px;
  font-weight: bold;
}

.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
} */



/****** IGNORE ******/
/* body { 
  width: 400px; 
  margin: 100px auto; 
  background-color: #f5f5f5; 
}

.copyright {
  display:block;
  margin-top: 100px;
  text-align: center;
  font-family: Helvetica, Arial, sans-serif;
  font-size: 12px;
  font-weight: bold;
  text-transform: uppercase;
}
.copyright a{
  text-decoration: none;
  color: #EE4E44;
} */


/****** CODE ******/

.file-upload{display:block;text-align:center;font-family: Helvetica, Arial, sans-serif;font-size: 12px;}
.file-upload .file-select{display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select .file-select-button{background:#dce4ec;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
.file-upload .file-select:hover{border-color:#34495e;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select:hover .file-select-button{background:#34495e;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select{border-color:#3fa46a;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload.active .file-select .file-select-button{background:#3fa46a;color:#FFFFFF;transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;}
.file-upload .file-select input[type=file]{z-index:100;cursor:pointer;position:absolute;height:100%;width:100%;top:0;left:0;opacity:0;filter:alpha(opacity=0);}
.file-upload .file-select.file-select-disabled{opacity:0.65;}
.file-upload .file-select.file-select-disabled:hover{cursor:default;display:block;border: 2px solid #dce4ec;color: #34495e;cursor:pointer;height:40px;line-height:40px;margin-top:5px;text-align:left;background:#FFFFFF;overflow:hidden;position:relative;}
.file-upload .file-select.file-select-disabled:hover .file-select-button{background:#dce4ec;color:#666666;padding:0 10px;display:inline-block;height:40px;line-height:40px;}
.file-upload .file-select.file-select-disabled:hover .file-select-name{line-height:40px;display:inline-block;padding:0 10px;}
</style>