<?php
$pageTitle = "SYSTEMNA | Edit Letter";
include "../template/header.php";
?>
<?php
//if($_SESSION['type'] != 'admin') header("location: index.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $priority=$_POST['priority'];
    $salary=$_POST['salary'];
    $date=date('Y/m/d h:i:s');
    $type_name=$_POST['type_name'];
    $sql="UPDATE requests SET priority = " . $priority .  " , salary = " . $salary . " , date = '" . $date . "' , type_name = '" . $type_name .  "' WHERE Request_id = " . $_POST['id'];
    $DB->query($sql);
    $DB->execute();
    header('Location: viewRequest.php');
}

else if (isset($_GET['id']))
{
    $requestId = $_GET['id'];
    $sql="SELECT * FROM requests WHERE Request_Id = " . $requestId;
    $DB->query($sql);
    $DB->execute();
    $selectedData = $DB ->getdata();
    if ($selectedData == NULL) header('Location: viewRequest.php');
} else { header('Location: viewRequest.php'); }

?>
<div>
    <form id="Addletterform" method='post'>
        <input type="hidden" name="id" value="<?php echo $requestId; ?>">
        <br>
        <h1 style='color:#DAA520;'> Choose the type of the letter that you want to apply for: </h1>
        <hr>
        <div class="Letterdiv" id="Letterdiv">
            <?php
            $sql = "SELECT * FROM requests_types";
            $DB->query($sql);
            $DB->execute();
            for($i=0; $i<$DB->numRows(); $i++){
                $x=$DB->getdata();
                $Name=$x[$i]->Name;
                $btnid=$x[$i]->Type_id;
                $desc=$x[$i]->description;
                echo "<div id='columnAddRequest' style='background-color:#EEE8AA;'>";
                echo "<br><br>";
                echo"<label><input type='radio' name='type_name' id='buttonsletter' value='$Name' ";
                echo $selectedData[0]->type_name == $Name ? 'checked' : '';
                echo "> $Name ($desc) </label>" ;
                echo "<br><br><br><br> ";
            }
            echo "<br><br>";
            echo "</div>";
            ?>
            <br>
            <hr>
            <br><br>
            <h4> Please choose the Letter priority : </h4>
            <label><input type="radio" name="priority" id ="rdbtn1" value="1" required <?php echo $selectedData[0]->priority == 1 ? 'checked' : '' ;?>> Urgent Request</label>
            <br>
            <label><input type="radio" name="priority" id ="rdbtn2" value="0" <?php echo $selectedData[0]->priority == 0 ? 'checked' : '' ;?>> Normal Request</label>
            <br><br><br>
            <h4> Please choose the type that you want : </h4>
            <label><input type="radio" name="salary" id ="rdbtn3" value="1" required <?php echo $selectedData[0]->salary == 1 ? 'checked' : '' ;?> > With Salary</label>
            <br>
            <label>
                <input type="radio" name="salary" id ="rdbtn4" value="0" <?php echo $selectedData[0]->salary == 0 ? 'checked' : '' ;?>> Without Salary
            </label>
            <br><br><br><br>
            <input type="submit" id="editLetterButton" value="UPDATE!">
        </div>
    </form>
    <?php include "../template/footer.php"; 

    ?>
