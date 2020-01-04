<?php 
$pageTitle = "SYSTEMNA | Notifications"; /* Setting the page title */
include "../template/header.php"; /* Including the header file */
?>
<div>
    <br>
    <h1 style='text-align: center;'>Latest Notifications!</h1>
    <a style='float:right; text-decoration: none; color:White; border-radius: 0.5em; background-color: #DAA520; padding: 8px;' id='all=1' class='deleteConfirmation' href='../operations/notiop.php'>Delete All</a>
    <table id="Display">
        <tr>
            <td>Notifications</td>
            <td>Operations</td>
        </tr>
        <?php
        try {
            $uid = $_SESSION['id']; /* Getting the user ID */
            /* SQL query to get the data from the DB */
            $sql = " SELECT * FROM notifications WHERE userid = $uid ";
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            for($i=$DB->numRows(); $i>0; --$i){ /* iterating the results by the num of rows */
                $x=$DB->getdata(); /* creates an array of the output result */
                /* Printing the output */
                echo "<tr>";
                echo "<td style='float: left; '>";
                echo ($i) . "- <a href='" . $x[$i-1]->notihref . "' style='text-decoration: none; color: #DAA520;'>" . $x[$i-1]->notidata . "</a>";
                echo "</td>";
                echo "<td>";
                echo "<a style='text-decoration: none; color:White; border-radius: 0.5em; background-color: #DAA520; padding: 8px;' id='nid=" . $x[$i-1]->ID . "' class='deleteConfirmation' href='../operations/notiop.php'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
        catch(Exception $e)
        {
            echo "<div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
            error_log("error while getting notifications data");
        }
        ?>
    </table>
</div>
<?php include "../template/footer.php"; /* Including the footer file */ ?>