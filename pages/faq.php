<?php
$pageTitle = "SYSTEMNA | FAQ"; /* Setting the page title */
include "../template/header.php"; /* Including the header file */
?>
<?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){echo('<div style="text-align: center; align-self: center;"><div class="pages_edit" id="faq_edit">Edit</div></div>');}  /* Adding the edit button if the user is an admin */ ?>
<div>
    <form style="float: right;"> <!-- The search bar, function is in backend.js using ajax -->
        <input type="text" id="searched" class="stextinput" size="70" maxlength="120" placeholder="Search">
    </form>
</div>
<div>
    <?php echo "<br>
            <h1 style='color:#DAA520'>Frequently Asked Questions!</h1>
            <br><br>" ; ?>
    <div class="faqdiv" id="faqdiv"> <!-- Printing the questions from the DB -->
        <?php /* SQL query to get the data from the DB */
        $sql = "
            SELECT *
            FROM faq
            ";
            try {
              $DB->query($sql); /* Using the query function made in DB/Database.php */
              $DB->execute(); /* Using the excute function made in DB/Database.php */
              for($i=0; $i<$DB->numRows(); $i++){ /* iterating the results by the num of rows */
                  $x=$DB->getdata(); /* creates an array of the output result */
                  /* Printing the output */
                  echo "<h2>" . ($i+1) . "- " . $x[$i]->Question . "</h2>" . "<br>";
                  echo "<h4>" . $x[$i]->Answer . "</h4>" . "<br>";
              }
              echo "<br><br>";

            } catch (\Exception $e) {
              $_SESSION['error'] = 'error in sql';
              error_log("Error while trying to access faq page");
              echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
            }
        ?>
    </div>
    <div class="askus">
        <h1 style="color:#DAA520">Didn't find your question ?</h1>
        <br>
        <h2>Send us an inquiry</h2>
        <br>
        <form method='post'> <!-- The inquiries form, functions are in backend.js using ajax -->
            Subject:<br><br><input type="text" name="subject" value="" id="faqinputtext">
            <br><br>
            Message:<br><br><textarea name="message" rows="8" cols="50" id="faqtextarea"></textarea>
            <br><br>
            <input type="button" id="faqsubmit" value="Submit">
            <br>
        </form>
    </div>
</div>

<?php include "../template/footer.php"; /* Including the footer file */ ?>
