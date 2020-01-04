<?php
include "../DB/Database.php";
$DB = new Database();

if(isset($_POST['type'])){
    $id=$_POST['mid'];// id of the employee that is requested to change his privilege
    $sql = "select * from employee where id = '$id';";//select that employee 
    try 
    {
        $DB->query($sql);
        $DB->execute();
        if($DB->numRows()>0)
        {
            for($i=0;$i<$DB->numRows();$i++)
            {$x = $DB ->getdata();
             echo $x[$i]->accepted;
             $acc = $x[$i]->accepted; }
            if($acc == 1){//check if the employee is accepted in the first place
                $type=$_POST['type'];// take the type that employee is change to
                $sql = "update employee set privilege='$type' where id = '$id';";//set that type to that employee
                $DB->query($sql);
                $DB->execute();
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }

}
if(isset($_POST['test'])){
    $sal=$_POST['test'];// salary that is to be changed
    $id=$_POST['id']; // id of the employee
    $sql= "select * from employee where id = '$id'";
    try{
        $DB->query($sql);
        $DB->execute();
        $x = $DB->getdata();
        if($x[0]->accepted != 1) //if he is not accepted echo to ajax
            echo $x[0]->accepted;
        else {
            $sql = "update add_info set salary='$sal' where emp_id = '$id';";//else update salary
            $DB->query($sql);
            $DB->execute();
            $assign = $DB->numRows();
            if($assign)//if query completed direct back to table
                header("Location: ../pages/index.php");
            else 
            {//else user might not have a row in additional info then a row has to be inserted with the salary
                $sql = "insert into add_info(emp_id,salary) values ('$id','$sal');";
                $DB->query($sql);
                $DB->execute();
                header("Location: ../pages/index.php");
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }

}
if(isset($_POST['aid'])){
    $ID = $_POST['aid']; //id of employee to accept 
    $sql = "update employee set accepted=1 where id = '$ID';";
    try{
        $DB->query($sql);
        $DB->execute();
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }
}
if(isset($_POST['rid'])){
    $ID = $_POST['rid'];//id of employee to reject
    $sql = "update employee set accepted=0 where id = '$ID';";
    try{
        $DB->query($sql);
        $DB->execute();
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }
}

if(isset($_POST['position']))
{
    $position=$_POST['position'];// salary that is to be changed
    $id=$_POST['id']; // id of the employee
    $sql= "select * from employee where id = '$id'";
    try{
        $DB->query($sql);
        $DB->execute();
        $x = $DB->getdata();
        if($x[0]->accepted != 1) //if he is not accepted echo to ajax
            echo $x[0]->accepted;
        else {
            $sql = "update add_info set position='$position' where emp_id = '$id';";//else update salary
            $DB->query($sql);
            $DB->execute();
            $assign = $DB->numRows();
            if($assign)//if query completed direct back to table
                echo "true";
            else 
            {//else user might not have a row in additional info then a row has to be inserted with the salary
                $sql = "insert into add_info(emp_id,position) values ('$id','$position');";
                $DB->query($sql);
                $DB->execute();
                echo "true";
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }

}
?>