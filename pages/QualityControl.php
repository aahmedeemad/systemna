<?php 
$pageTitle = "SYSTEMNA | Quality Control";
include "../template/header.php"; 
?>
<br>
<div style="text-align: center;">
    <h1 style="font-family: sans-serif;" id="QCtitle">Dashboard</h1>
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
        <th>Request ID</th>
        <th>Employee Name</th>
        <th>Request Name</th>
        <th>Employee ID</th>
        <th>Salary</th>
        <th>Date</th>
        <th>Priority</th>
        <th>Comment</th>
    </tr>
    <?php
    /* To check if ther is a data in this row */
    function check($c){
        if($c==null)
            $c='-';
        else if($c=='')
            $c='-';
        return $c;
    }
    /* Sql query */
    $sql="
        SELECT requests_types.Name , employee.username , requests.date , requests.Request_id ,
               requests.status , requests.emp_id , priority , salary
        FROM requests INNER JOIN requests_types
        ON requests.type_name = requests_types.Name
        INNER JOIN employee 
        ON employee.id = emp_id
        ";
    /* We used try & catch to handle the Errord that might occur */    
    try
    {
        $DB->query($sql); // Sending the Query to the Db via Pdo class
        $DB->execute(); // Running the Query 
        $y = 0; // Counter for number of rows in the table
        if($DB->numRows()>0) // To check if there is data in the Db
        {
            for($i=0;$i<$DB->numRows();$i++)
            {
                $x = $DB->getdata(); // To fetch all The data in the shape of an array
                $y++;
                // Dividing the indicies of the array to each variable
                $EmpName = check($x[$i]->username);
                $id = check($x[$i]->Request_id);
                $RequestName =check($x[$i]->Name);
                $Empid = check($x[$i]->emp_id);
                $salary = check($x[$i]->salary);
                $priority = check($x[$i]->priority);
                $date = check($x[$i]->date);

                $Boolsalray = "No Salary";
                $BoolPriority = "Urgent";

                // To check if the letter with salary or not
                if($salary == 1)
                {
                    $Boolsalray ="With Salary";
                }
                else $Boolsalray ="No Salary";

                // To know the priority of the letter
                if($priority == 1)
                {
                    $BoolPriority ="Urgent";
                }
                else $BoolPriority="Normal";

                // Retreiving the data in the form of table rows & columns
                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "
                <td>{$id}</td>
                <td>{$EmpName}</td>
                <td>{$RequestName}</td>
                <td>{$Empid}</td> 
                <td>{$Boolsalray}</td>
                <td>{$date}</td>
                <td>{$BoolPriority}</td>
                ";

    ?>
    <!-- Comment Side  -->
    <td class ="Comment">
        <form action="../operations/AddComment.php" method="post">
            <input type='text' name="Comment" id="qccomment" placeholder='Write your comment here...'size='30' required>
            <br>
            <input type="text" name="Request_id" value="<?php echo $x[$i]->Request_id?>" hidden>
            <input type="text" name="User_id" value="<?php echo $x[$i]->emp_id?>" hidden>
            <input type='submit' id="qcsubmit" value="Submit Comment" name="AddC">
        </form>    
    </td>

    <?php
        echo "</tr>";
            }
        }
        else {
            echo "<td colspan='9'>- No data to show -</td>";
        }
    }
    /* To return to if there was an error */
    catch(Exception $e)
    {
        $_SESSION['error'] = 'Error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("Error while getting QC table");
    }?>
</table>
<?php include "../template/footer.php"; 