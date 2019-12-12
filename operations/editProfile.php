<?php
include_once "../DB/Database.php";
$DB = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /**************** Done ************************/
    if ($_POST['type'] == "fullname")
    {
        $_POST['value'] = filter_var($_POST['value'], FILTER_SANITIZE_STRING);
    }

    /**************** Done ************************/
    if ($_POST['type'] == "ssn")
    {
        if(!filter_var($_POST['value'], FILTER_VALIDATE_INT))
        {
            echo "Invalid SSN Format";
            return;
        }

        if($_POST['value'][0] != '2')
        {
            echo "SSN must start with 2";
            return;
        }

        if(strlen($_POST['value']) != 14)
        {
            echo "SSN number must be 14";
            return;
        }
    }


    /**************** Done ************************/
    if ($_POST['type'] == "email")
    {
        $_POST['value'] = filter_var($_POST['value'], FILTER_SANITIZE_STRING);
        $_POST['value'] = filter_var($_POST['value'], FILTER_SANITIZE_EMAIL);
        if(!filter_var($_POST['value'], FILTER_VALIDATE_EMAIL))
        {
            echo "Invalid Email Format";
            return;
        }
    }

    /**************** Done ************************/
    if ($_POST['type'] == "phone")
    {    
        $_POST['value'] = substr($_POST['value'] , 1);
        if(!filter_var($_POST['value'], FILTER_VALIDATE_INT))
        {
            echo "Invalid Phone Format";
            return;
        }
        else {
            $_POST['value'] = "0" . $_POST['value'];
        }
        if(strlen($_POST['value']) != 11)
        {
            echo "Phone number must be 11";
            return;
        }
    }

    /**************** Done ************************/
    if ($_POST['type'] == "username")
    {    
        $_POST["value"] = filter_var($_POST["value"], FILTER_SANITIZE_STRING);
        if(strlen($filteredname)>2){
            try{
                $sql="SELECT * FROM employee where username= '".$_POST["value"]."'  ";
                $DB->query($sql);
                $DB->execute();
                if($DB->numRows()>0)
                {
                    echo"Username already exists";

                }
                else{
                    $sql="UPDATE employess VALUES(NULL, :id , :oldvalue , :value, :type, 2)" ;
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
                }
            }catch (Exception $e) {
                echo "Error!! please try after minutes";
            }
        }
        else{
            echo"Invalid username";
        }
    }



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



}
else {
    header('Location: ../pages/index.php');
}

?>
