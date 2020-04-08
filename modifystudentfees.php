<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
        
    
        $userid=$_POST['userid'];
        $table_name = "user_student";
        $f1 = $_POST["f1"];
        $f2 = $_POST["f2"];
        $f3 = $_POST["f3"];
        

        $sql = "UPDATE $table_name set f1 = '$f1', f2 = '$f2' , f3 = '$f3' WHERE id='$userid'";



if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Student details updated successfully');
        window.location.href = './view-fees-pending.php?term=all';
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