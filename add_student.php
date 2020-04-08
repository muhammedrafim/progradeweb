<?php
include 'db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
        
    
        
        $table_name = "user_student";
        $id = $_POST["id"];
        $added_by = $_POST["added_by"];
        $added_at = "0000"; //Server time
        $name = $_POST["name"];
        $cla = $_POST["cla"];
        $batch = $_POST["batch"];
        $pwd = $_POST["pwd"];
        $photo = $_FILES['photourl']['name'];
        $parentname = $_POST["parentname"];
        $parentemail = $_POST["parentemail"];
        $parent_pwd = $_POST["parent_pwd"];
        $photourl = $base.'profilepics/'.$photo;
      
        $r = mysqli_query($conn,"select * from user_student where id=$id");
    
        if(mysqli_num_rows($r) == 0){

            $sql = "INSERT INTO $table_name (id, added_by, added_at, name, class, batch, pwd, photourl, parentname, parentemail, parent_pwd,f1,f2,f3)
VALUES ('$id', '$added_by', '$added_at', '$name', '$cla', '$batch', '$pwd', '$photourl', '$parentname', '$parentemail', '$parent_pwd','false','false','false')";


            if ($conn->query($sql) === TRUE) {
                echo  "<script> alert('User added');
                window.location.href='./admin-student-list.php';
                            </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $target_dir = "profilepics/";
            $target_file = $target_dir . basename($_FILES["photourl"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            if (move_uploaded_file($_FILES["photourl"]["tmp_name"], $target_file)) {
                $done="true";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }

        }
        else
        {
            echo  "<script> alert('id already exits');
            window.location.href='./admin-add-student.php';
                        </script>";
        }
}


else{
    // Prevent accessing form via URL
    echo "Authentication failure";
}
?>