<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
        
        $current_id=$_POST['current_id'];
        $table_name = "library_books";
        $id = $_POST["id"];
        $name = $_POST["name"];
        $author = $_POST["author"];
        $cat = $_POST["category"];
        $status = $_POST['status'];

        $sql = "UPDATE $table_name set id = '$id', name = '$name' , author = '$author',category = '$cat', status = '$status'  WHERE id='$current_id'";



if ($conn->query($sql) === TRUE) {
    echo "<script>alert('book modified');
    window.location.href='./admin-view-books.php';
    </script>"; 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}   

else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>