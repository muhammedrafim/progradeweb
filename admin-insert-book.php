<?php
include 'db_connect.php';



//printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    if ( isset( $_POST["id"] ) ) {
        /* ... proceed ... */
        $id = $_POST["id"];
        $name = $_POST["name"];
        $author = $_POST["author"];
        $category = $_POST["category"];
        
    if (empty($id)||empty($name)||empty($author)||empty($category)) {
        echo "Empty fields";
    } else {
        //update database
        $query = "INSERT INTO library_books (id, name, author, category, status)
        SELECT * FROM (SELECT '$id', '$name', '$author', '$category', '0') AS tmp
        WHERE NOT EXISTS (
            SELECT name FROM library_books WHERE id = '$id'
        ) LIMIT 1";
        $conn->query($query);
        if(($conn->affected_rows)==0){
            echo "<script>alert('Book already exists')</script>";
        }
        else{
            echo "<script>alert('book inserted');
            window.location.href='./admin-view-books.php';
            </script>"; 
        
        }
    }}
    else{
        echo "Application error";
    }  
}
else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>