<?php 
$pageTitle = "SYSTEMNA | Change Info Requests";
include "../template/header.php"; 
?>
<?php if(!isset($_SESSION['username'])){header('Location: ../index.php');}
if($_SESSION['type']=='user'){header('Location: lettertypes.php');}    ?>
<br>
<h1 style="text-align:center">Waiting Users</h1>
<!--
<input type=text id='tblsearch' class='tblsearch' placeholder='Search'>
<select id='choice' class='tblselect'>
    <option value="email">Email</option>
    <option value="ssn">SSN</option>
    <option value="username">UserName</option>
</select>
-->


<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>Status</th>
        <th>ID</th>
        <th>FullName</th>
        <th>Username</th>
        <th>Email</th>
        <th>Location</th>
        <th>SSN</th>
        <th>Passport_ID</th>
        <th>Birthday</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Salary</th>
        <th>Delete</th>
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
        on emp_id=id where employee.accepted = 0 AND privilege = 'user'";
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
                $bdate=check($x[$i]->bdate);
                $salary=check($x[$i]->salary);
                $passport_id=check($x[$i]->passport_id);
                $gender=check($x[$i]->gender);
                $fullname=check($x[$i]->fullname);
                $username = check($x[$i]->username);
                $email = check($x[$i]->email);
                $location = check($x[$i]->location);




                echo  "<tr>";
                echo "<td>{$y}</td>";
                if($x[$i]->accepted==1)
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=1&id={$id}' id='button-accepted'>Accepted</a></td>";
                else if($x[$i]->accepted==0)
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=0&id={$id}' id='button-rejected'>Rejected</a></td>";
                else 
                    echo "<td><a type='submit' href='../operations/EditTable.php?accepted=2&id={$id}' id='button-pending'>Pending</a></td>";
                echo "
                <td>{$id}</td>
                <td>{$fullname}</td>
                <td>{$username}</td>
                <td>{$email}</td>
                <td>{$location}</td>
                <td>{$ssn}</td>
                <td>{$passport_id}</td>
                <td>{$bdate}</td>
                <td>{$phone}</td>
                <td>{$gender}</td>
                <td ><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
    ?>
    <td><a type='submit' onclick="return confirm('Delete this account?')"
           href="../operations/DeleteTable.php?id=<?php echo $x[$i]->id ;?>" class='EditBtn'>Delete</a></td>

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