<?php

include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /* ... proceed ... */
        
        $id = $_POST["id"];
        $tablename = "library_books";
    
        //DELETE ROWS
        $query = "DELETE FROM $tablename WHERE id='$id'";
        $conn->query($query);
        if(($conn->affected_rows)==0){
            echo "<script>alert('book  deletion error');
            window.location.href='./admin-view-books.php';
            </script>";
        }
        else{
            echo "<script>alert('book deleted');
            window.location.href='./admin-view-books.php';
            </script>"; 

        }
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>