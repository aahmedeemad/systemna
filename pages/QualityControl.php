<?php 
$pageTitle = "SYSTEMNA | Quality Control";
include "../template/header.php"; 
?>
<br>
<div style="text-align: center;">
<h1 style="font-family: sans-serif;">Quality Control</h1>
<input type="text" id='QCtblsearch' class='tblsearch' placeholder='Search'>
<select id='choice' class='tblselect'>
    <option value="empname">Employee Name</option>
    <option value="requestname">Request Name</option>
    <option value="empid">Employee ID</option>
</select>
</div>
<table id='Display'>
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
        function check($c){
         if($c==null)
          $c='-';
         else if($c=='')
          $c='-';
          return $c;
        }

        $sql="
        SELECT requests_types.Name , Employee.username ,requests.date, requests.Request_id , requests.status , requests.emp_id , priority , salary
        FROM Requests INNER JOIN requests_types
        ON Requests.type_name = requests_types.Name
        INNER JOIN employee 
        ON employee.id = emp_id
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
                $id = check($x[$i]->Request_id);
                $RequestName =check($x[$i]->Name);
                $Empid = check($x[$i]->emp_id);
                $salary = check($x[$i]->salary);
                $priority = check($x[$i]->priority);
                $date = check($x[$i]->date);
                
                $Boolsalray = "No Salary";
                $BoolPriority = "Urgent";

                if($salary == 1)
                {
                    $Boolsalray ="With Salary";
                }
                else $Boolsalray ="No Salary";
                
                if($priority == 1)
                {
                    $BoolPriority ="Urgent";
                }
                else $BoolPriority="Normal";

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
                <td class ="Comment">
                    <form action="../operations/AddComment.php?Request_id=<?php echo $x[$i]->Request_id?>" method="post">
                        <input type='text' name="Comment" id="qccomment" placeholder='Write your comment here...'size='30' required>
                        <br>
                        <input type='submit' id="qcsubmit" onclick ="return alert ('Your Comment has been added ')" value="Submit Comment" name="AddC">
                    </form>    
                </td>
                </tr>
    <?php
        }
    }
  }
  catch(Exception $e)
  {
      $_SESSION['error'] = 'error in sql';
  }?>
</table>
<?php include "../template/footer.php"; 