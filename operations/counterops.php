<?php
session_start();
include('../DB/Database.php');
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['type'] == "setnoticounter")
    {
        $uid = $_SESSION['id'];
        $sql = " SELECT * FROM notifications WHERE userid = $uid AND status = 0 ";
        $DB->query($sql);
        $DB->execute();
        echo($DB->numRows());
    }
    else if ($_POST['type'] == "setprofilecounter")
    {
        $uid = $_SESSION['id'];
        $sql=" SELECT * FROM update_info left join employee on update_info.UID = employee.id WHERE update_info.Status = 2 and UID <> '$uid' ";
        $DB->query($sql);
        $DB->execute();
        echo ($DB->numRows());
    }
    else if ($_POST['type'] == "setusrsletterrequestscounter")
    {
        $sql = " SELECT e.fullname, rt.Name, r.Request_id, r.emp_id, r.type_name, r.Status, r.priority, r.salary FROM requests r, employee e, requests_types rt WHERE e.id=r.emp_id AND r.type_name=rt.Name ";
        $DB->query($sql);
        $DB->execute();
        echo ($DB->numRows());
    }
    else if ($_POST['type'] == "setownletterrequestscounter")
    {
        $sql = "SELECT * FROM requests INNER join requests_types on requests.type_name=requests_types.Name WHERE emp_id='".$_SESSION['id']."'";
        $DB->query($sql);
        $DB->execute();
        echo ($DB->numRows());
    }
    else if ($_POST['type'] == "setusrscounter")
    {
        $sql = "SELECT * FROM employee WHERE accepted = 2 ";
        $DB->query($sql);
        $DB->execute();
        echo ($DB->numRows());
    }
}
else 
{
    header("location: ../index.php");
}
?>