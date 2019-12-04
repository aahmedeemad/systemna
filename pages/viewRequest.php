<?php include "../template/header.php"; ?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
 if($_SESSION['type']=='user'){header('Location:lettertypes.php');}    ?>



<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>User ID</th>
        <th>Status</th>
        <th>Applied for Letter</th>
        <th>Priority</th>
        <th>Salary</th>

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
        on Type_id=Type_id where emp_id='".$_SESSION['id']."'";
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
                $id=$x[$i]->id;
                $emp_id=$x[$i]->$_SESSION['id'];
                $priority=check($x[$i]->priority);
                $salary=check($x[$i]->salary);

                echo  "<tr>";
                echo "<td>{$y}</td>";
                if($x[$i]->Status==1)
                    echo "<td>Accepted</td>";
                else if($x[$i]->Status==0)
                    echo "<td>Rejected</td>";
                else
                    echo "<td>Pending</td>";
                if($x[$i]->Status==1)
                        echo "<td>URGENT</td>";
                else
                        echo "<td>NORMAL</td>";

                if($x[$i]->priority==1)
                        echo "<td>WITH Salary</td>";
                else
                        echo "<td>WITHOUT SALARY</td>";

                echo "
                <td>{$id}</td>
                <td>{$priority}</td>
                <td>{$salary}</td>
              ";
                ?>
    </tr>
    <?php
            }
        }
        else {
          echo "You have no requests now !";
        }
      }
      catch(Exception $e)
      {
          $_SESSION['error'] = 'error in sql';
      }

        ?>
</table>

<?php include "../template/footer.php"; ?>
