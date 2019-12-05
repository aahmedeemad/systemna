<?php
$pageTitle = "SYSTEMNA | Requested Letters";
include "../template/header.php";
?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
    ?>



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


                if($x[$i]->priority==1){
                        echo "<td>URGENT</td>";}
                else{
                        echo "<td>NORMAL</td>";}

                if($x[$i]->priority==1){
                        echo "<td>WITH Salary</td>";}
                else{
                        echo "<td>WITHOUT SALARY</td>";}

                if($x[$i]->Status==2){
                ?>
                <td><a type='submit' onclick="return confirm('Delete this Request?')"
                      href="../operations/deleterequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn'>Delete</a></td>

                <td><a type='submit' onclick="return confirm('Delete this Request?')"
                      href="../operations/editrequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn'>Edit</a></td>


    </tr>
    <?php
                 }
                else
                 echo "<td></td>";
                  echo "<td></td>";

            }
        }
        else {
          echo"<tr><td colspan=7>No matches found </td></tr>";
        }
      }
      catch(Exception $e)
      {
          $_SESSION['error'] = 'error in sql';
      }

        ?>
</table>

<?php include "../template/footer.php"; ?>
