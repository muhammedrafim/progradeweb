<?php

include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* ... proceed ... */
        
        $type = $_POST["usertype"];
        $id = $_POST["userid"];
        $tablename = "user_".$type;
    
        //DELETE ROWS
        $query = "DELETE FROM $tablename WHERE id='$id'";
        $conn->query($query);
        if(($conn->affected_rows)==0){
            print("error");
        }
        else{
            echo "<script>alert('Deleted');
            window.location.href =  './admin-student-list.php';
                    </script>";


        }
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>