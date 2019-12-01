<?php include "template/header.php"; ?>

<body>
    <div>
        <div class="faqdiv">
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
            <form>
                Subject:<br><br><input type="text" name="" value="" id="faqinputtext" required>
                <br><br>
                Message:<br><br><textarea name="name" rows="8" cols="50" id="faqtextarea" required></textarea>
                <br><br>
                <input type="submit" name="" value="Submit" id="faqsubmit">
                <br>
            </form>
        </div>
    </div>
</body>

<?php include "template/footer.php"; ?>
