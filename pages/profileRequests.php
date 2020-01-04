<?php
$pageTitle = "SYSTEMNA | Profile Requests";
include "../template/header.php"; 
?>
<?php if($_SESSION['type']!='admin') header('Location:MakeLetter.php'); ?>
<br>
<table id='tblRequests'>
    <tr id='must'>
        <th>#</th>
        <th>ID</th>
        <th>UserID</th>
        <th>User</th>
        <th>OldValue</th>
        <th>Value</th>
        <th>Type</th>
        <th>Accept</th>
        <th>Reject</th>
    </tr>
    <?php
    $sid = $_SESSION['id'];
    $sql="
        SELECT *
        FROM update_info inner join employee on update_info.UID = employee.id
        where update_info.Status = 2 and UID <> '$sid'
              "; //select all profile request except for the one of the logined admin
    try
    {
        $DB->query($sql);
        $DB->execute();
        $y=0;
        if($DB->numRows()>0)
        {   
            $x=$DB->getdata();
            for($i=0;$i<$DB->numRows();$i++)
            {
                //$x=$DB->getdata();
                $y++;
                $id=$x[$i]->ID;
                $userId=$x[$i]->UID;
                $userName=$x[$i]->username;
                $oValue=$x[$i]->OldValue;
                $value=$x[$i]->Value;
                $type=$x[$i]->Type;
                echo  "<tr>";
                echo "<td>{$y}</td>";

                echo "
                <td>{$id}</td>
                <td>{$userId}</td>
                <td>{$userName}</td>
                <td>{$oValue}</td>
                <td>{$value}</td>
                <td>{$type}</td>";
                echo "<td><input type= 'submit' class ='accept' value='Accept'></td>";// button for accepting
                echo "<td><input type= 'submit' class ='reject' value= 'Reject'></td>";// button for rejecting
    ?>

    <?php
                echo "</tr>";
            }
        }
        else if($DB->numRows() ==0)
        {
          echo "<tr><td colspan=12 >No Data to show</td></tr>";//show that there is no data if table is empty
        }
    }
    catch(Exception $e)//if there is an error in sql query catch exception
    {
        $_SESSION['error'] = 'error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("error while getting profile requests");
    }

    ?>
</table>

<?php
include "../template/footer.php"; ?>