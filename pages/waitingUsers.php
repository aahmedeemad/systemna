<?php 
$pageTitle = "SYSTEMNA | Waiting Users";
include "../template/header.php"; 
?>
<?php if($_SESSION['type']=='user') header('Location: lettertypes.php'); ?>
<br>
<div style="text-align: center;">
<h1 style="font-family: sans-serif;">Waiting Users</h1>
<input type=text id='tblsearch' class='tblsearch' placeholder='Search'>
<select id='choice' class='tblselect'>
    <option value="email">Email</option>
    <option value="ssn">SSN</option>
    <option value="username">UserName</option>
</select>
</div>
<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>SSN</th>
        <th>Phone</th>
        <th>Delete</th>
        <th>Accept</th>
        <th>Reject</th>
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
        SELECT *
        FROM employee left join add_info
        on emp_id=id where employee.accepted = 2 AND privilege = 'user' AND active = 1";
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
                $phone=check($x[$i]->phone);
                $ssn=check($x[$i]->ssn);
                $username = check($x[$i]->username);
                $email = check($x[$i]->email);




                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "
                <td>{$id}</td>
                <td>{$username}</td>
                <td>{$email}</td>
                <td>{$ssn}</td>
                <td>{$phone}</td>";
                ?>
    <td><a type='submit' onclick="return confirm('Delete this account?')"
            href="../operations/DeleteTable.php?wid=<?php echo $x[$i]->id ;?>" class='EditBtn'>Delete</a></td>
    <td><input type= submit class ='user-accept' value='Accept'></td>
    <td><input type= submit class ='user-reject' value='Reject'></td>

    </tr>
    <?php
            }
        }
      }
      catch(Exception $e)
      {
          $_SESSION['error'] = 'error in sql';
      }

        ?>
</table>

<?php include "../template/footer.php"; ?>