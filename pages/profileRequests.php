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
        FROM update_info1 left join employee on update_info1.UID = employee.id
        where update_info1.Status = 2 and UID <> '$sid'
              ";
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
                echo "<td><input type= 'submit' class ='accept' value='Accept'></td>";
                echo "<td><input type= 'submit' class ='reject' value= 'Reject'></td>";
    ?>

    <?php
                echo "</tr>";
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }

    ?>
</table>

<?php
include "../template/footer.php"; ?>