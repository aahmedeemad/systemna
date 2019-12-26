<?php 
$pageTitle = "SYSTEMNA | Mass Messaging";
include "../template/header.php"; ?>
<style>
    .vertical {
        display: block;
        border-left: 0.5vw solid #daa520;
        height: 89vh;
    }
    .horizontal {
        display: none;
        border-bottom: 1vw solid #daa520;
        width: 99.5vw;
    }
    @media screen and (max-width: 800px) {
        .vertical {
            display: none;
        }
        .horizontal {
            display: block;
            padding-top: 5em;
        }
        table td {
            display: inline-block;
        }
    }
</style>
<table style="width: 100%;">
    <tr>
        <td>
            <div>
                <h2>Send notification</h2>
                <br>
            </div>
            <fieldset>
                <label>Select the user ID/Name:</label>
                <select class="massmsgdrpdwn" id="notione">
                    <?php
                    echo ('<option value = "0" disabled selected>'." ".'</option>');
                    $sql = "SELECT * FROM employee";
                    $DB->query($sql);
                    $DB->execute();
                    $x=$DB->getdata();
                    for ($i=0; $i<$DB->numRows(); $i++) { 
                        echo ('<option value = "' . $x[$i]->id . '">' . $x[$i]->id . " - " . $x[$i]->fullname . '</option>');
                    } ?>
                </select>
            </fieldset>
            <form method='post'>
                <br><legend>Notification content:</legend>
                <textarea name="notification" rows="8" cols="50" class="massmsgfield" required></textarea>
                <br><br>
                <input type="button" class="massmsgsendbtn" id="notisendone" value="Send to selected user">
                <input type="button" class="massmsgsendbtn" id="notisendall" value="Send to all users">
            </form>
        </td>
        <td><div class = "vertical"></div><div class = "horizontal"></div></td>
        <td>
            <div>
                <h2>Send mail</h2>
                <br>
            </div>
            <div id="mailone">
                <fieldset>
                    <label>Select the user ID/Name/Email:</label>
                    <select class="massmsgdrpdwn">
                        <?php
                        echo ('<option value = "$i" disabled selected>'." ".'</option>');
                        $sql = "SELECT * FROM employee";
                        $DB->query($sql);
                        $DB->execute();
                        $x=$DB->getdata();
                        for ($i=0; $i<$DB->numRows(); $i++) { 
                            echo ('<option value = "' . $x[$i]->email . '">' . $x[$i]->id . " - " . $x[$i]->fullname . " - " . $x[$i]->email . '</option>');
                        } ?>
                    </select>
                </fieldset>
            </div>
            <div id="mailall">
                <?php
                $sql = "SELECT * FROM employee";
                $DB->query($sql);
                $DB->execute();
                $x=$DB->getdata();
                /*for ($i=0; $i<$DB->numRows(); $i++) {
					echo ($x[$i]->email);
				}*/ ?>
            </div>
            <br><legend>From: <?php echo($_SESSION["name"] . ' from SYSTEMNA');?></legend>
            <br><legend>Mail subject:</legend>
            <input type="text" class="massmsgfield" required>
            <br><legend>Mail content:</legend>
            <textarea name="mail" rows="8" cols="50" class="massmsgfield" required></textarea>
            <br><br>
            <input type="submit" class="massmsgsendbtn" id="mailsendone" onclick="" value="Send to selected user">
            <input type="submit" class="massmsgsendbtn" id="mailsendall" onclick="" value="Send to all users">
        </td>
    </tr>
</table>

<?php include "../template/footer.php"; ?>