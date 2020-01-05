<?php
$pageTitle = "SYSTEMNA | FAQ";
include "../template/header.php";
if($_SESSION['type']!='admin') header('Location:MakeLetter.php'); 
?>

<div>
    <br>
    <h1 style='text-align: center;'>Latest Notifications!</h1>
    <a style='float:right; text-decoration: none; color:White; border-radius: 0.5em; background-color: #DAA520; padding: 8px;' id='all=1' class='deleteConfirmation' href='../operations/faqop.php'>Delete All</a>
    <table id="Display">
        <tr id='must'>
            <td>Inquiry</td>
            <td>Operations</td>
        </tr>
        <?php
        try {
            /* SQL query to get the data from the DB */
            $sql = " SELECT * FROM inquiries";
            $DB->query($sql); /* Using the query function made in DB/Database.php */
            $DB->execute(); /* Using the excute function made in DB/Database.php */
            for($i=$DB->numRows(); $i>0; --$i){ /* iterating the results by the num of rows */
                $x=$DB->getdata(); /* creates an array of the output result */
                /* Printing the output */
                echo "<tr>";
                echo "<td style='float: left; '>";
                echo "<b>Message ID: </b> " . $x[$i-1]->id . "<br>";
                echo "</td>";
                echo "<td style='float: left; '>";
                echo "<b>Requested by: </b> " . $x[$i-1]->requester_name ;
                echo "</td>";
                echo "<td style='float: left; '>";
                echo "<b>Requester email: </b> " . $x[$i-1]->requester_email ;
                echo "</td>";
                echo "<td style='float: left; '>";
                echo "<br><b>Requester ID: </b> " . $x[$i-1]->requester_id ;
                echo "</td>";
                echo "<td style='float: left; '>";
                echo "<b>Message subject: </b> " . $x[$i-1]->subject ;
                echo "</td>";
                echo "<td style='float: left; '>";
                echo "<br><b>Message content: </b> " . $x[$i-1]->message ;
                echo "</td>";
                echo "<td>";
                echo "<a style='text-decoration: none; color:White; border-radius: 0.5em; background-color: #DAA520; padding: 8px;' id='nid=" . $x[$i-1]->id . "' class='deleteConfirmation' href='../operations/faqop.php'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        }
        catch(Exception $e)
        {
            echo "<div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
            error_log("error while getting inquiries data");
        }
        ?>
    </table>
</div>

<?php include "../template/footer.php"; ?>