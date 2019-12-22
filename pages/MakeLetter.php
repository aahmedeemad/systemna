<?php
ob_start();
$pageTitle = "SYSTEMNA | Letters";
include "../template/header.php";
?>
<?php

if (isset($_POST['priority'])) {

    $emp_id=$_SESSION['id'];
    $priority=$_POST['priority'];
    $Status=2;
    $salary=$_POST['salary'];
    $date=date('Y/m/d h:i:s');
    $type_name=$_POST['type_name'];

    $sql="INSERT INTO requests (emp_id,Status,priority,salary,date,type_name)
      VALUES ('$emp_id','$Status','$priority','$salary','$date','$type_name') ";
    $DB->query($sql);
    $DB->execute();

    header("location: .php");
}
?>
<?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){echo('<div style="text-align: center; align-self: center;"><div style="align: center;" class="pages_edit" id="add_letter" onclick="addletter.send()"></div></div>');}?>
<div>
    <form id="Addletterform" method='post'>
        <?php echo "<br>
          <h1 style='color:#DAA520;'> Choose the type of the letter that you want to apply for: </h1>
          <hr>" ; ?>
        <div class="Letterdiv" id="Letterdiv">
            <?php
            $sql = "SELECT *
          FROM requests_types";
            $DB->query($sql);
            $DB->execute();
            for($i=0; $i<$DB->numRows(); $i++){
                $x=$DB->getdata();
                $Name=$x[$i]->Name;
                $btnid=$x[$i]->Type_id;
                $desc=$x[$i]->description;
            ?>
            <div id="row1">
                <form>
                    <div id="columnAddRequest" style="background-color:#EEE8AA;">
                        <br>  <br>
                        <?php
                echo"<label><input type='radio' name='Letterbuttonn' id='buttonsletter' value='$Name'> $Name ($desc) </label>" ;
                echo "<br><br><br><br> ";
            }
            echo "<br><br>";
                        ?>
                    </div>
                    <br>
                    <hr>
                    <br><br>
                    <div >

                        <h4> Please choose the Letter priority : </h4>
                        <label><input type="radio" name="Option1" id ="rdbtn1" value="Urgent"
                                      required> Urgent Request</label><br>

                        <label><input type="radio" name="Option1" id ="rdbtn2" value="Normal">
                            Normal Request</label><br>
                    </div><br><br>
                    <div>
                        <h4> Please choose the type that you want : </h4>
                        <label><input type="radio" name="Option" id ="rdbtn3" value="With"
                                      required> With Salary</label><br>

                        <label><input type="radio" name="Option" id ="rdbtn4" value="Without">
                            Without Salary</label><br>
                        <br><br><br>
                        <input type="submit" id="submitbtn" value="Apply!">

                        </form>
                    </div>

                <?php
                ob_end_flush();
                include "../template/footer.php"; ?>
