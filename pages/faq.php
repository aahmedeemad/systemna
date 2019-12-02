<?php include "../template/header.php"; ?>
<?php include "../template/searchbar.php"; ?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}?>
<body>
    <div>
        <div class="faqdiv" id="faqdiv">
            <?php
            $sql = "
            SELECT *
            FROM faq
            ";
            $DB->query($sql);
            $DB->execute();
            echo "<br>
            <h1 style='color:#DAA520'>Frequently Asked Questions!</h1>
            <br><br>" ;
            for($i=0; $i<$DB->numRows(); $i++){
                $x=$DB->getdata();
                echo "<h2>" . $x[$i]->ID . "- " . $x[$i]->Question . "</h2>" . "<br>";
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
                $subject=$_POST['subject'];
                $message=$_POST['message'];
                $requester_name=1;
                $requester_email=1;
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
                <input type="submit" id="faqsubmit" value="Submit" >
                <br>
            </form>
        </div>
    </div>
</body>

<?php include "../template/footer.php"; ?>
