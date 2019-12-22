<script src="../js/jquery-3.4.1.min.js"></script>
<?php include "../DB/Database.php";
session_start();
$DB2 = new Database(); 
if($_SESSION['type']=='user') header('Location:lettertypes.php');
if(isset($_POST['search'])){    ?>
<br>
<table id='Display' >
    <tr id='must'>
        <th>#</th>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>SSN</th>
        <th>Salary</th>
        <th>Add QC</th>
        <th>Add HR</th>
        <th>Delete</th>
        <th>Profile</th>
        <th>Status</th>
    </tr>
    <?php
    $search = $_POST['search'];
    $by = $_POST['by'];
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
        on emp_id=id where employee.active = 1 AND privilege = 'user' AND accepted <> 2 ";
    if(!empty($search)){
        $sql = $sql."AND ".$by." LIKE '%$search%'";
    }
    try
    {
        $DB2->query($sql);
        $DB2->execute();
        $y=0;
        if($DB2->numRows()>0)
        {   $x=$DB2->getdata();
            for($i=0;$i<$DB2->numRows();$i++)
            {
                //$x=$DB->getdata();
                $y++;
                $id=$x[$i]->id;
                $phone=check($x[$i]->phone);
                $ssn=check($x[$i]->ssn);
                $bdate=check($x[$i]->bdate);
                $salary=check($x[$i]->salary);
                $fullname=check($x[$i]->fullname);
                $username = check($x[$i]->username);
                $email = check($x[$i]->email);
                $location = check($x[$i]->location);

                echo  "<tr>";
                echo "<td>{$y}</td>";
                /*if($x[$i]->accepted==1)
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=1&id={$id}' id='button-accepted'>Accepted</a></td>";
                else if($x[$i]->accepted==0)
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=0&id={$id}' id='button-rejected'>Rejected</a></td>";
                else 
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=2&id={$id}' id='button-pending'>Pending</a></td>";*/
                echo "
                <td>{$id}</td>
                <td>{$username}</td>
                <td>{$email}</td>
                <td>{$ssn}</td>
                <td><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
    ?>
    <td><input type='submit'
           href="" class='modify' value ='+QC'></td>
    <td><input type='submit'
           href="" class='modify' value ='+HR'></td>
    <td><a type='submit' onclick="return confirm('Delete this account?')"
           href="../operations/DeleteTable.php?id=<?php echo $x[$i]->id ;?>" class='EditBtn'>Delete</a></td>
    
<?php
if($x[$i]->accepted == 1){
 echo "<td><a type='submit' 
 href='../pages/userProfile.php?id={$x[$i]->id}' class='EditBtn'>Profile</a></td>";
 echo "<td><a  type='submit'  id='button-accepted'>Accepted</a></td>";
}
else if($x[$i]->accepted == 0)
{
 echo "<td></td>";
 echo "<td><a type='submit' id='button-rejected'>Rejected</a></td>";
}

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
<?php } ?>
<script src="../js/backend.js"></script>
        <script src="../js/bootstrap.min.js"></script>