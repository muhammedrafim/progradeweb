<?php

include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        /* ... proceed ... */
        
        $id = $_POST["id"];
        $tablename = "notification";
    
        //DELETE ROWS
        $query = "DELETE FROM $tablename WHERE id='$id'";
        $conn->query($query);
        if(($conn->affected_rows)==0){
            echo"<script>alert('Error NOt deleted');
            window.location.href='./admin-add-notifications.php';
            </script>";
        }
        else{ echo"<script>alert('Notification  deleted');
            window.location.href='./admin-add-notifications.php';
            </script>";}
    
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>