<?php
$pageTitle = "SYSTEMNA | Letters";
include "../template/header.php";
?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
  ?>
  <div>
      <?php echo "<br>
          <h1 style='color:#DAA520'> Choose the type of the letter that you want to apply for : </h1>
          <br><hr><br><br>" ; ?>
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
              <div id="column2" style="background-color:#EEE8AA;">
            <br>  <br>
              <?php
            echo"<label><input type='radio' name='Letterbutton' value='$Name'> $Name ($desc) </label>" ;
            echo "<br><br><br><br><br> ";
          }
          echo "<br><br>";
          ?>

      </div>

<br>
<hr>
<br><br>
  <div id="Priorityform">
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
</div>
  </form>

<?php include "../template/footer.php"; ?>
