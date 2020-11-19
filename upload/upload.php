<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<!-- <style>
</style> -->
<title>Fileupload to database in PHP</title>
</head>
<body class="container">
<?php
// Include the database configuration file
include 'config.php';
$statusMsg = '';

// File upload path
$targetDir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $db->query("INSERT into images (file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
            if($insert){
                $statusMsg = '<p class="text text-success">The file '.$fileName.' has been uploaded successfully.</p>';
            }else{
                $statusMsg = '<p class="text text-danger">File upload failed, please try again.</p>';
            } 
        }else{
            $statusMsg = '<p class="text text-default">Sorry, there was an error uploading your file.</p>';
        }
    }else{
        $statusMsg = '<p class="text text-info">Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.</p>';
    }
}else{
    $statusMsg = '<p class="text text-warning">Please select a file to upload.</p>';
}

// Display status message
echo $statusMsg;
?>
</body>
</html>