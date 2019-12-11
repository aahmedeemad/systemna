<?php
include_once "../DB/Database.php";
$DB = new Database();
    $sql="INSERT INTO update_info1 VALUES(NULL, :id , :oldvalue , :value, :type, 2)" ;
    $DB->query($sql);
    $DB->bind(':id',$_POST['id']);
    $DB->bind(':oldvalue',$_POST['oldvalue']);
    $DB->bind(':value',$_POST['value']);
    $DB->bind(':type',$_POST['type']);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "true";
    }


//
//if ($_POST['type'] == "fullname")
//{
//    $sql="INSERT INTO update_info1 VALUES(NULL, :id , :oldvalue , :value, :type, 2)" ;
//    $DB->query($sql);
//    $DB->bind(':id',$_POST['id']);
//    $DB->bind(':oldvalue',$_POST['oldvalue']);
//    $DB->bind(':value',$_POST['value']);
//    $DB->bind(':type',$_POST['type']);
//    $DB->execute();
//    if($DB->numRows() > 0)
//    {
//        echo "true";
//    }
//}
//else if($_POST['type'] == "email")
//{
//    $sql="INSERT INTO update_info1 VALUES(NULL, :id , :oldvalue , :value, :type, 2)" ;
//    $DB->query($sql);
//    $DB->bind(':id',$_POST['id']);
//    $DB->bind(':oldvalue',$_POST['oldvalue']);
//    $DB->bind(':value',$_POST['value']);
//    $DB->bind(':type',$_POST['type']);
//    $DB->execute();
//    if($DB->numRows() > 0)
//    {
//        echo "true";
//    }  
//}
//else if ($_POST['type'] == "phone")
//{
//    $sql="INSERT INTO update_info VALUES(NULL, :id , :email, :phone, NULL, :type, 0)";
//    $DB->query($sql);
//    $DB->bind(':id',$_POST['id']);
//    $DB->bind(':email',$_POST['email']);
//    $DB->bind(':phone',$_POST['phone']);
//    $DB->bind(':type',$_POST['type']);
//    $DB->execute();
//    if($DB->numRows() > 0)
//    {
//        echo "true";
//    }  
//}
//else if ($_POST['type'] == "company-info")
//{
//    $sql="INSERT INTO update_info VALUES(NULL, :id , :uname, :pass, NULL, :type, 0)" ;
//    $DB->query($sql);
//    $DB->bind(':id',$_POST['id']);
//    $DB->bind(':uname',$_POST['uname']);
//    $DB->bind(':pass',$_POST['pass']);
//    $DB->bind(':type',$_POST['type']);
//    $DB->execute();
//    if($DB->numRows() > 0)
//    {
//        echo "true";
//    }  
//}
//else {
//    header("Location: ../pages/profile.php");
//}

?>
