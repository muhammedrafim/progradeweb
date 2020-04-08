<?php

include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
        
        
        
        $table_name = "notification";
        $id = uniqid();
        $title = $_POST["title"];
        $content = $_POST["content"];
        $date = round(microtime(true) * 1000);
        $author = $_POST["author"];
        $photourl = $_FILES["photourl"]['name'];
        
        $sql = "INSERT INTO $table_name (id, title, content, date, author, photourl)
        VALUES ('$id', '$title', '$content', $date, '$author', '$photourl')";

if ($conn->query($sql)) {
        echo "notification added";
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

//var_dump($result);
        
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
            
    }
    else{
        echo "Application error";
    }  
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>