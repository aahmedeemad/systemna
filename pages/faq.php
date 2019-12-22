<?php 
$pageTitle = "SYSTEMNA | FAQ";
include "../template/header.php"; 
?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}?>

<body>
    <?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){echo('<div style="text-align: center; align-self: center;"><div style="align: center;" class="pages_edit" id="faq_edit" onclick="editFAQ.send()"></div></div>');}?>
    <div>
        <form style="float: right;">
            <input type="text" id="searched" class="stextinput" size="70" maxlength="120" placeholder="Search">
        </form>
    </div>
    <div>
        <?php echo "<br>
            <h1 style='color:#DAA520'>Frequently Asked Questions!</h1>
            <br><br>" ; ?>
        <div class="faqdiv" id="faqdiv">
            <?php
            $sql = "
            SELECT *
            FROM faq
            ";
            $DB->query($sql);
            $DB->execute();
            for($i=0; $i<$DB->numRows(); $i++){
                $x=$DB->getdata();
                echo "<h2>" . ($i+1) . "- " . $x[$i]->Question . "</h2>" . "<br>";
                echo "<h4>" . $x[$i]->Answer . "</h4>" . "<br>";
            }
            echo "<br><br>";
            ?>
        </div>
        <div class="askus">
            <h1 style="color:#DAA520">Didn't find your question ?</h1>
            <br>
            <h2>Send us an inquiry</h2>
            <br>
            <?php
            if (isset($_POST['subject'])) {
                $subject=filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
                $message=filter_var($_POST['message'], FILTER_SANITIZE_STRING);
                $requester_name=$_SESSION['username'];
                $requester_email=$_SESSION['email'];
                $sql="INSERT INTO inquiries (subject,message,requester_name,requester_email) VALUES ('$subject','$message','$requester_name','$requester_email') ";
                $DB->query($sql);
                $DB->execute();
            }
            ?>
            <form method='post'>
                Subject:<br><br><input type="text" name="subject" value="" id="faqinputtext" required>
                <br><br>
                Message:<br><br><textarea name="message" rows="8" cols="50" id="faqtextarea" required></textarea>
                <br><br>
                <input type="submit" id="faqsubmit" value="Submit">
                <br>
            </form>
        </div>
    </div>
</body>

<?php include "../template/footer.php"; ?>