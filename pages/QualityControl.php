<?php 
$pageTitle = "SYSTEMNA | Quality Control";
include "../template/header.php"; 
?>
<link rel="stylesheet" href="../css/QC_style.css">
<h1>Quality Control</h1>
<input type="search" id='QCtblsearch' class='QCtblsearch' placeholder='Search' style="left:500px;padding:25px;">
<select id='choice' class='tblselect' style="left:510px;padding:15px">
    <option value="empname">Employee Name</option>
    <option value="requestname">Request Name</option>
    <option value="empid">Employee ID</option>
</select>
<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>Request ID</th>
        <th>Employee Name</th>
        <th>Request Name</th>
        <th>Employee ID</th>
        <th>Salary</th>
        <th>Priority</th>
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
        SELECT requests_types.Name , Employee.username , requests.Request_id , requests.status , requests.emp_id , priority , salary
        FROM Requests INNER JOIN requests_types
        ON Requests.Type_id = requests_types.Type_id 
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
                <td>{$BoolPriority}</td>";
                ?></tr>
    <?php
        }
    }
  }
  catch(Exception $e)
  {
      $_SESSION['error'] = 'error in sql';
  }?>
</table>
<br><br><br><br><br><br><br><br>
<div class="AddComment">
<h2>Add a Comment !</h2>
<br>
<textarea placeholder="Add your comment here..." name="" id="" cols="60" rows="10"></textarea>
<br><br>
<input type="submit" value="Submit Comment">
</div>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/backend.js"></script>
