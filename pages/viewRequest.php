<?php
$pageTitle = "SYSTEMNA | Requested Letters";
include "../template/header.php";
?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
    ?>

<BR></BR>
<h1 style="text-align:center">Your Requests</h1>
<br><br>
<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>User ID</th>
        <th>Status</th>
        <th>Applied for Letter</th>
        <th>Priority</th>
        <th>Salary</th>
        <th>Delete</th>
        <th>Edit</th>

    </tr>
    <?php
        function check($c){
         if($c==null)
          $c='-';
         else if($c=='')
          $c='-';
          return $c;
        }

        $sql="  SELECT *
        FROM requests INNER join requests_types
        on requests.Type_id=requests_types.Type_id where emp_id='".$_SESSION['id']."'";
        try
        {

        $DB->query($sql);
        $DB->execute();
        $y=0;
        if($DB->numRows()>0)
        {
            for($i=0;$i<$DB->numRows();$i++)
            {
                $x=$DB->getdata();
                $y++;
                $id=$x[$i]->Request_id;
                $emp_id=$_SESSION['id'];
                $priority=check($x[$i]->priority);
                $salary=check($x[$i]->salary);

                
                $Boolsalray = "Without Salary";
                $BoolPriority = "Urgent";

                if($salary == 1)
                {
                    $Boolsalray ="With Salary";
                }
                else $Boolsalray ="Without Salary";
                
                if($priority == 1)
                {
                    $BoolPriority ="Urgent";
                }
                else $BoolPriority="Normal";

                echo  "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>$emp_id</td>";

                if($x[$i]->Status==1){
                    echo "<td>Accepted</td>";}
                else if($x[$i]->Status==0){
                    echo "<td>Rejected</td>";}
                else{
                    echo "<td>Pending</td>";
                  }
                  if($x[$i]->Type_id==1){
                      echo "<td>General HR Letter</td>";}
                  else if($x[$i]->Type_id==2){
                      echo "<td>Embassy HR Letter</td>";}
                      else if($x[$i]->Type_id==3){
                          echo "<td>HR Letter directed to specific organization</td>";}
                  else{
                      echo "<td>HR Letter to whom it may concern</td>";
                    }
                    echo "<td>{$BoolPriority}</td>";
                    echo "<td>{$Boolsalray}</td>";
/*              

                if($x[$i]->priority==1){
                        echo "<td>Urgent</td>";}
                else{
                        echo "<td>Normal</td>";}

                if($x[$i]->salary==0){
                        echo "<td>With Salary</td>";}
                else{
                        echo "<td>Without Salary</td>";}

                if($x[$i]->Status==2){*/
                ?>
                <td><a type='submit' onclick="return confirm('Delete this Request?')"
                      href="../operations/deleterequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn'>Delete</a></td>

                <td><a type='submit' onclick="return confirm('Edit this Request?')"
                      href="../operations/editrequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn1'>Edit</a></td>
    </tr>
    <?php
                 }
                /*else
                 echo "<td></td>";
                  echo "<td></td>";
*/
          
        }
        else {
          echo"<tr><td colspan=8>You have no requests for now ! </td></tr>";
        }
      }
      catch(Exception $e)
      {
          $_SESSION['error'] = 'error in sql';
      }

        ?>
</table>

<?php include "../template/footer.php"; ?>
