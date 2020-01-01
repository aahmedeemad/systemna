<?php
$pageTitle = "SYSTEMNA | Letters";
include "../template/header.php";
?>

<?php 
if(isset($_SESSION['type']) && $_SESSION['type']=='admin') {
    echo('<div style="text-align: center; align-self: center;">
    <div style="align: center;" class="pages_edit" id="letter_edit"></div>
    </div>');
} 
?>

<div style="text-align: center; align-self: center;" >
    <input type="hidden" id="id" class="hidden" value="<?php echo $_SESSION['id']; ?>">
    <br>
    <h1 style='color:#DAA520;'> Choose the type of the letter that you want to apply for: </h1>
    <hr>
    <div class="Letterdiv" id="Letterdiv">
        <?php
        try {
            $sql = "SELECT * FROM requests_types";
            $DB->query($sql);
            $DB->execute();
            for($i=0; $i<$DB->numRows(); $i++){
                $x=$DB->getdata();
                $Name=$x[$i]->Name;
                $btnid=$x[$i]->Type_id;
                $desc=$x[$i]->description;
                echo "<div id='columnAddRequest' style='background-color: #EEE8AA;'>";
                echo "<br><br>";
                echo "<label><input type='radio' class name='Letterbuttonn' id='buttonsletter' value='$Name'> $Name ($desc) </label>";
                echo "<br><br><br> ";
                echo "<br><br>";
                echo "</div>";
            }
        ?>
        <br>
        <hr>
        <br><br>
        <h4> Please choose the Letter priority : </h4>
        <label><input type="radio" name="Option1" id ="rdbtn1" value="Urgent" required> Urgent Request</label>
        <br>
        <label><input type="radio" name="Option1" id ="rdbtn2" value="Normal"> Normal Request</label>
        <br><br><br>
        <h4> Please choose the type that you want : </h4>
        <label><input type="radio" name="Option" id ="rdbtn3" value="With" required> With Salary</label>
        <br>
        <label><input type="radio" name="Option" id ="rdbtn4" value="Without">Without Salary</label><br>
        <br><br><br>
        <input type="button" id="applyForLetterBtn" value="Apply!">
    </div>
    <?php 
        } catch (Exception $e) {
            echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
            error_log("Error while adding letter");
        }
    ?>
</div>

<?php include "../template/footer.php"; ?>
