<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $data = json_decode(file_get_contents('php://input'), true);
        
        
        $photourl=' ';
        $table_name = "notification";
        $id = uniqid();
        $title = $_POST["title"];
        $content = $_POST["content"];
        $date = round(microtime(true) * 1000);
        $author = $_POST["added_by"];
        $photo = $_FILES['photourl']['name'];
        if($photo != ' ')
        {
        $photourl = $base.'pics/'.$photo;
        }
        $sql = "INSERT INTO $table_name (id, title, content, date, author, photourl)
        VALUES ('$id', '$title', '$content', $date, '$author', '$photourl')";

if ($conn->query($sql)) {
    
    $url = 'http://localhost/prograde/firebase_push.php';
    $data = array('title' => $title, 'message' => $content, 'topic' => 'notifications');

    // use key 'http' even if you send the request to https://...
    $options = array(
    'http' => array(
    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
    'method'  => 'POST',
    'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { /* Handle error */ }
        echo "<script>alert('Notification added Succesfully');
        window.location.href='./admin-add-notifications.php';</script>";
}
if($photo != ' ')
{
$target_dir = "pics/";
$target_file = $target_dir . basename($_FILES["photourl"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
 if (move_uploaded_file($_FILES["photourl"]["tmp_name"], $target_file)) {
     $done="true";
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
   }
   }
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>