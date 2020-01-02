<?php 
$pageTitle = "SYSTEMNA | View Comment";
include "../template/header.php"; 
?>
<br>
<div style="text-align: center;">
    <h1 style="font-family: sans-serif;" id="QCtitle">Your Comments</h1>
    <input type="text" id='QCtblsearch' class='tblsearch' placeholder='Search'>
    <select id='choice' class='tblselect'>
        <option value="empname">Employee Name</option>
        <option value="requestname">Request Name</option>
        <option value="empid">Employee ID</option>
    </select>
</div>
<table id='Display' class="QCTbl">
    <tr id='must'>
        <th>#</th>
        <th>Comment ID</th>
        <th>Employee Name</th>
        <th>Request Name</th>
        <th>Employee ID</th>
        <th>Comment</th>
        <th colspan="4">Actions</th>
    </tr>
    <?php
    function check($c){
        if($c==null)
            $c='-';
        else if($c=='')
            $c='-';
        return $c;
    }

    $sql="
      SELECT comment.Comment_id , comment.Value , comment.user_id , requests.type_name , employee.username
      FROM comment INNER JOIN employee 
      ON comment.user_id = employee.id 
      INNER JOIN requests
      ON comment.Request_id = requests.Request_id;
        ";
    try
    {

        $DB->query($sql);
        $DB->execute();
        $y = 0;
        if($DB->numRows()>0)
        {
            for($i=0;$i<$DB->numRows();$i++)
            {
                $x = $DB->getdata();
                $y++;
                $EmpName = check($x[$i]->username);
                $id = check($x[$i]->Comment_id);
                $RequestName =check($x[$i]->type_name);
                $Empid = check($x[$i]->user_id);
                $Comment = check($x[$i]->Value);

                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "
                <td>{$id}</td>
                <td>{$EmpName}</td>
                <td>{$RequestName}</td>
                <td>{$Empid}</td> 
                <td>{$Comment}</td> 
                ";
                

    ?>
<td colspan="2"><a href="../operations/EditComment.php.php?id=<?php echo $x[$i]->Comment_id ;?> " class='EditBtn1'>Edit</a></td>    
<td colspan="3"><a href="../operations/DeleteComment.php?id=<?php echo $x[$i]->Comment_id ;?> " class='deleteConfirmation EditBtn'>Delete</a></td>

    <?php
    
        echo "</tr>";
            }
        }
        else {
            echo "<td colspan='9'>- No data to show -</td>";
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("error while getting QC table");
    }?>
</table>
<?php include "../template/footer.php"; 