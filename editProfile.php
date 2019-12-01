<?php
include_once "Database.php";
$DB = new Database();
if ($_POST['type'] == "fullname")
{
    $sql="INSERT INTO update_info VALUES(NULL, :id , :fullname, NULL, NULL, :type, 0)" ;
    $DB->query($sql);
    $DB->bind(':id',$_POST['id']);
    $DB->bind(':fullname',$_POST['fullname']);
    $DB->bind(':type',$_POST['type']);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "true";
    }
}
else if($_POST['type'] == "basic-info")
{
    $sql="INSERT INTO update_info VALUES(NULL, :id , :ssn, :loc, :bdate, :type, 0)" ;
    $DB->query($sql);
    $DB->bind(':id',$_POST['id']);
    $DB->bind(':ssn',$_POST['ssn']);
    $DB->bind(':loc',$_POST['loc']);
    $DB->bind(':bdate',$_POST['bdate']);
    $DB->bind(':type',$_POST['type']);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "true";
    }  
}
else if ($_POST['type'] == "contact-info")
{
    $sql="INSERT INTO update_info VALUES(NULL, :id , :email, :phone, NULL, :type, 0)";
    $DB->query($sql);
    $DB->bind(':id',$_POST['id']);
    $DB->bind(':email',$_POST['email']);
    $DB->bind(':phone',$_POST['phone']);
    $DB->bind(':type',$_POST['type']);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "true";
    }  
}
else if ($_POST['type'] == "company-info")
{
    $sql="INSERT INTO update_info VALUES(NULL, :id , :uname, :pass, NULL, :type, 0)" ;
    $DB->query($sql);
    $DB->bind(':id',$_POST['id']);
    $DB->bind(':uname',$_POST['uname']);
    $DB->bind(':pass',$_POST['pass']);
    $DB->bind(':type',$_POST['type']);
    $DB->execute();
    if($DB->numRows() > 0)
    {
        echo "true";
    }  
}
else {
    header("Location: profile.php");
}

?>
