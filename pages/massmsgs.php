<?php 
$pageTitle = "SYSTEMNA | Mass Messaging"; /* Setting the page title */
include "../template/header.php"; /* Including the header file */
?>
<style>
    @media screen and (max-width: 800px) {
        table td {
            display: inline;
        }
    }
</style>
<table style="width: 100%;">
    <?php
    if ($_SESSION['error'] == 'error in sql') {
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    } ?>
    <tr>
        <td>
            <div>
                <h2>Send notification</h2>
                <br>
            </div>
            <fieldset>
                <label>Select the user ID/Name:</label>
                <select class="massmsgdrpdwn" id="notione">
                    <?php try {
                    /* Creating the dropdown empty option */
                    echo ('<option value = "0" disabled selected>'." ".'</option>');
                    /* SQL query to get the data from the DB */
                    $sql = "SELECT * FROM employee";
                    $DB->query($sql); /* Using the query function made in DB/Database.php */
                    $DB->execute(); /* Using the excute function made in DB/Database.php */
                    $x=$DB->getdata(); /* creates an array of the output result */
                    for ($i=0; $i<$DB->numRows(); $i++) { /* iterating the results by the num of rows */
                        /* Creating the dropdown options from DB */
                        echo ('<option value = "' . $x[$i]->id . '">' . $x[$i]->id . " - " . $x[$i]->fullname . '</option>');
                    }
                }
                catch(Exception $e)
                {
                    $_SESSION['error'] = 'error in sql';
                    error_log("error in massmsgs page");
                }?>
                </select>
            </fieldset>
            <form method='post'> <!-- The notification form, functions are in backend.js using ajax -->
                <br><legend>Notification content:</legend>
                <textarea name="notification" rows="8" cols="50" class="massmsgfield" id="massnoti" required></textarea>
                <br><br>
                <?php if ($_SESSION['error'] == 'error in sql') { echo "<div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>"; } ?>
                <input type="button" class="massmsgsendbtn" id="notisendone" value="Send to selected user" <?php if ($_SESSION['error'] == 'error in sql') { echo "style='display: none;'"; } ?>>
                <input type="button" class="massmsgsendbtn" id="notisendall" value="Send to all users" <?php if ($_SESSION['error'] == 'error in sql') { echo "style='display: none;'"; } ?>>
            </form>
        </td>
        <td><div class = "vertical"></div><div class = "horizontal"></div></td>
        <td>
            <div>
                <h2>Send mail</h2>
                <br>
            </div>
            <fieldset>
                <label>Select the user ID/Name/Email:</label>
                <select class="massmsgdrpdwn" id="mailone">
                    <?php try {
                    /* Creating the dropdown empty option */
                    echo ('<option value = "$i" disabled selected>'." ".'</option>');
                    /* SQL query to get the data from the DB */
                    $sql = "SELECT * FROM employee";
                    $DB->query($sql); /* Using the query function made in DB/Database.php */
                    $DB->execute(); /* Using the excute function made in DB/Database.php */
                    $x=$DB->getdata(); /* creates an array of the output result */
                    for ($i=0; $i<$DB->numRows(); $i++) { /* iterating the results by the num of rows */
                        /* Creating the dropdown options from DB */
                        echo ('<option value = "' . $x[$i]->email . '">' . $x[$i]->id . " - " . $x[$i]->fullname . " - " . $x[$i]->email . '</option>');
                    }
                }
                catch(Exception $e)
                {
                    $_SESSION['error'] = 'error in sql';
                    error_log("error in massmsgs page");
                }?>
                </select>
            </fieldset>
            <form method='post'> <!-- The mail form, functions are in backend.js using ajax -->
                <!-- Getting the mail 'from' from the session -->
                <br><legend>From: <?php echo($_SESSION["name"] . ' from SYSTEMNA');?></legend>
                <br><legend>Mail subject:</legend>
                <input type="text" name="mailsubject" class="massmsgfield" id="mailsubject" required>
                <br><legend>Mail content:</legend>
                <textarea name="mailcontent" rows="8" cols="50" class="massmsgfield" id="mailcontent" required></textarea>
                <br><br>
                <?php if ($_SESSION['error'] == 'error in sql') { echo "<div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>"; } ?>
                <input type="button" class="massmsgsendbtn" id="mailsendone" value="Send to selected user" <?php if ($_SESSION['error'] == 'error in sql') { echo "style='display: none;'"; } ?>>
                <input type="button" class="massmsgsendbtn" id="mailsendall" value="Send to all users" <?php if ($_SESSION['error'] == 'error in sql') { echo "style='display: none;'"; } ?>>
            </form>
        </td>
    </tr>
</table>

<?php include "../template/footer.php"; /* Including the footer file */ ?>