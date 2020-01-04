<?php 
$pageTitle = "SYSTEMNA | Notifications"; /* Setting the page title */
include "../template/header.php"; /* Including the header file */
?>
<div>
	<?php
    try {
        $uid = $_SESSION['id']; /* Getting the user ID */
        /* SQL query to get the data from the DB */
        $sql = " SELECT * FROM notifications WHERE userid = $uid ";
        $DB->query($sql); /* Using the query function made in DB/Database.php */
        $DB->execute(); /* Using the excute function made in DB/Database.php */
        echo "<br>
        <h1 style='text-align: center;'>Latest Notifications!</h1>
        <br><br>" ;
        for($i=$DB->numRows(); $i>0; --$i){ /* iterating the results by the num of rows */
            $x=$DB->getdata(); /* creates an array of the output result */
            echo ($i) . "- <a href='" . $x[$i-1]->notihref . "' style='text-decoration: none; color: #DAA520;'>" . $x[$i-1]->notidata . "</a>" . "<button type='button' style='float: right; border-radius: 0.5em; background-color: #DAA520;' >Delete</button>" . "<hr>"; /* Printing the output */
        }
    }
    catch(Exception $e)
    {
        echo "<div class='alert alert-danger'>Error please try again later</div>";
        error_log("error while getting notifications data");
    }
    ?>
</div>
<?php include "../template/footer.php"; /* Including the footer file */ ?>