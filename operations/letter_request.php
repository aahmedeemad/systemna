<?php
include "../template/header.php";
/*include "../DB/Database.php";*/
$DB = new Database();
if($_SESSION['type']!='admin') header('Location:MakeLetter.php');
if(isset($_POST['addLetter'])){
    $id=$_POST['id'];
    $body=filter_var($_POST['body'], FILTER_SANITIZE_STRING);
    $name=filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
    $userid=$_POST['userid'];
    try
    {
        $sql="insert into special_request (request_id,Name,body) values ('$id','$name','$body')";
        $DB->query($sql);
        $DB->execute(); 

        $sql = "update requests set Status='1' where Request_id = '$id';";
        $DB->query($sql);
        $DB->execute();
        
        $sql="insert into notifications (status,userid,notidata) values ('0','$userid','An action has been made to a letter request.')";
        $DB->query($sql);
        $DB->execute();
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("Error while getting waiting users");
    }
    header("Location: ../pages/letterRequests.php");
}


if(isset($_GET['id'])){

    $id = $_GET['id'];
    $status = $_GET['status'];
    $userid = $_GET['userid'];
    $name=$_GET['name'];
    if ($name=='Other' && $status=='1'){
?>
<div>
    <form action="" method="post" >
        <div>

            <h4>Tyoe the title of the letter: </h4>
            <input required type="text" id="Name" name="Name" placeholder="new letter name.." >
            <br>
            <h4>Letter body: </h4>

            <p style="background-color:#dcdc6f">Please type the letter for the specified employee.'  </p>
            <input type="hidden" name ='id' value='<?php echo $id; ?>'>
            <input type="hidden" name ='userid' value='<?php echo $id; ?>'>

            <textarea required rows="20"  id="letterBodyArea" name="body"  style="width:100%;" placeholder="body of the new letter.." ></textarea>

            <br><br><br><br>
            <input type="submit" name="addLetter" id = "AddLetter" value="Add Letter">

        </div>
    </form> 
</div>
<?php
                                       }else{
        try {
            $sql = "update requests set Status='$status' where Request_id = '$id';";
            $DB->query($sql);
            $DB->execute();
            $sql="insert into notifications (status,userid,notidata) values ('0','$userid','An action has been made to a letter request.')";
            $DB->query($sql);
            $DB->execute();
        }catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("Error while getting waiting users");
    }
        header("Location: ../pages/letterRequests.php");
    }}

?>


