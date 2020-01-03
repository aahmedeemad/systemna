<?php
session_start();
if (isset($_POST['id'])){
    $Name=$_POST['id'];
    $date=$_POST['date'];
    $salary=$_POST['salary'];
    $id=$_SESSION['id'];
    $request_id=$_POST['request_id'];

    try{

        include'../DB/Database.php';
        $DB=new Database();

        if($Name=='Other'){

            $sql="SELECT body,Name FROM special_request where request_id= '$request_id'; " ;
            $DB->query($sql);
            $DB->execute();
            $info=$DB->getdata();
            $additional='0';
            $Name=$info[0]->Name;
        }
        else{
        $sql="SELECT t.body ,t.Name ,r.additional_info,r.type_name FROM requests_types t , requests r where request_id='$request_id' and r.type_name=t.Name; " ;
            
        $DB->query($sql);
        $DB->execute();
        $info=$DB->getdata();
        $additional=$info[0]->additional_info;
        }
        echo '<center><b>'.$Name.'</b></center> <br>';
        $body=$info[0]->body;
                
        $name=$_SESSION['name'];
        $body=str_replace('(.NAME.)',$name,$body);
        $body=str_replace('(.DATE.)',$date,$body);
        if($additional=='0'){
        
        $body=str_replace('ADDITIONAL',"",$body);
        }
        else
        {
            $body=str_replace('(.ADDITIONAL.)',$additional,$body);
            
        }
        if($salary==1){


            $sql="SELECT salary FROM add_info where emp_id= $id " ;
            $DB->query($sql);
            $DB->execute();
            $x=$DB->getdata();
            $body=str_replace('(.SALARY.)','their current gross salary is EGP '.$x[0]->salary.' per annum.',$body);
        }
        else {
            $body=str_replace('(.SALARY.)',"",$body);
        }

        $body=str_replace('(.POSITION.)',"modeer amn",$body);
        $body=str_replace('(.START.)',"JAN 1940",$body);
        echo $body;
    }

    catch(Exception $e)
    {
        echo $e->getMessage();
        error_log("Error while accessing view letter");
    }
}
