<?php 
$pageTitle = "SYSTEMNA | Inquiries"; /* Setting the page title */
include "../template/header.php"; /* Including the header file */
?>
<div>
	<?php /* SQL query to get the data from the DB */
	$sql = "
    SELECT *
    FROM inquiries
    ";
    $DB->query($sql); /* Using the query function made in DB/Database.php */
    $DB->execute(); /* Using the excute function made in DB/Database.php */
    echo "<br>
    <h1 style='color:#DAA520'>Latest Inquiries!</h1>
    <br><br>" ;
    for($i=$DB->numRows(); $i>0; --$i){ /* iterating the results by the num of rows */
    $x=$DB->getdata(); /* creates an array of the output result */
    /* Printing the output */
    echo "<hr><br>" . "<b>Message ID: </b>" . $x[$i-1]->id . "<br><b>Requested by: </b>" . $x[$i-1]->requester_name . "<br><b>Requester email: </b>" . $x[$i-1]->requester_email . "<br><b>Requester ID: </b>" . $x[$i-1]->requester_id . "<br><br>" . "<b>Message subject: </b>" . $x[$i-1]->subject . "<br><b>Message content: </b>" . $x[$i-1]->message . "<br>";
    echo "<br><br>";
    }
    ?>
</div>
<?php include "../template/footer.php"; /* Including the footer file */ ?>