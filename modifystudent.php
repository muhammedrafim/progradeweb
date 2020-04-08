<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
        
    
        $userid=$_POST['userid'];
        $table_name = "user_student";
        $id = $_POST["id"];
        $name = $_POST["name"];
        $cla = $_POST["cla"];
        $batch = $_POST["batch"];
        $pwd = $_POST["pwd"];
        $parentname = $_POST["parentname"];
        $parentemail = $_POST["parentemail"];
        $parent_pwd = $_POST["parent_pwd"];
      

        $sql = "UPDATE $table_name set id = '$id', name = '$name' , class = '$cla',batch = '$batch',pwd='$pwd' ,
         parentname = '$parentname',parentemail='$parentemail' , parent_pwd='$parent_pwd' WHERE id='$userid'";



if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Student details updated successfully');
        window.location.href = './admin-student-list.php';
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