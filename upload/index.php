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
<center><h3 class="fas fa-h3">File Upload in PHP</h3></center> <br><br><br>
<label class="text-info">Please Upload image</label>

    <form action="upload.php" class="form form-inline" method="POST" enctype="multipart/form-data">
        <div class="col-sm-4">
            <input type="file" name="file" class="form-control" />
        </div>
        <div class="col-sm-1">
            <input type="submit" name="submit" value="Upload" class="btn btn-small btn-warning" />
        </div>
    </form>
    <br><br><br>
    <?php
        // Include the database configuration file
        include 'config.php';

        // Get images from the database
        $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");

        if($query->num_rows > 0){
            while($row = $query->fetch_assoc()){
                $imageURL = 'uploads/'.$row["file_name"];
        ?>
            <img src="<?php echo $imageURL; ?>" alt="" />
        <?php }
        } else{ ?>
            <p class="text text-danger">No image(s) found...</p>
        <?php } ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>