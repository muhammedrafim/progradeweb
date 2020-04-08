<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        
        $table_name = "study_material";
        $title = $_POST["name"];
        $class = $_POST["class"];
        $batch = $_POST["batch"];
        $date = round(microtime(true) * 1000);
        $author = $_POST["added_by"];
        $photo = $_FILES['file']['name'];

        $fileurl = $base.'studymaterials/'.$photo;
        
        $sql = "INSERT INTO $table_name (name, class, batch, date, added_by, fileurl)
        VALUES ('$title', '$class', '$batch', '$date', '$author', '$fileurl')";

if ($conn->query($sql)) {
    
        echo "<script>alert('Study material  added Succesfully');
        window.location.href='./admin-add-study-material.php';</script>";
}

$target_dir = "studymaterials/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
     $done="true";
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
   }
   }

else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>