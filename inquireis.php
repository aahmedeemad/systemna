<?php include "template/header.php"; ?>

<div>
	<?php
	$sql = "
    SELECT *
    FROM inquiries
    ";
    $DB->query($sql);
    $DB->execute();
    echo "<br>
    <h1 style='color:#DAA520'>Latest Inquireis!</h1>
    <br><br>" ;
    for($i=$DB->numRows(); $i>=0; --$i){
    $x=$DB->getdata();
    echo "<h2> Message ID: " . $x[$i]->id . "<br>" . "Requested by: " . $x[$i]->requester_name . "</h2>" . "<br><h4>" . "Requester email:" . $x[$i]->requester_email . "</h4>" . "<br>" . "Message subject: " . $x[$i]->subject . "<br>" . "Message content: " . $x[$i]->message . "<br>";
    }
    echo "<br><br>";
    ?>
</div>

<?php include "template/footer.php"; ?>