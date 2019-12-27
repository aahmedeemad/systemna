<?php 
$pageTitle = "SYSTEMNA | Inquiries";
include "../template/header.php"; 
?>
<div>
	<?php
	$sql = "
    SELECT *
    FROM inquiries
    ";
    $DB->query($sql);
    $DB->execute();
    echo "<br>
    <h1 style='color:#DAA520'>Latest Inquiries!</h1>
    <br><br>" ;
    for($i=$DB->numRows(); $i>0; --$i){
    $x=$DB->getdata();
    echo "<hr><br>" . "<b>Message ID: </b>" . $x[$i-1]->id . "<br><b>Requested by: </b>" . $x[$i-1]->requester_name . "<br><b>Requester email: </b>" . $x[$i-1]->requester_email . "<br><b>Requester ID: </b>" . $x[$i-1]->requester_id . "<br><br>" . "<b>Message subject: </b>" . $x[$i-1]->subject . "<br><b>Message content: </b>" . $x[$i-1]->message . "<br>";
    echo "<br><br>";
    }
    ?>
</div>

<?php include "../template/footer.php"; ?>