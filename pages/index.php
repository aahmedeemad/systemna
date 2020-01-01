<?php
$pageTitle = "SYSTEMNA | All Users";
include "../template/header.php"; 
?>
<?php if($_SESSION['type']!='admin')  header('Location:MakeLetter.php'); ?>
<style type="text/css">
    @media only screen and (max-width: 1200px) {
        #Display,
        #tblRequests {
            display: block;
            overflow: auto;
        }
    }
</style>
<br>
<div style="text-align: center;">
    <h1 style="font-family: sans-serif;">Dashboard</h1>
    <input type='text' id='tblsearch' class = 'tblsearch' placeholder='Search'>
    <select id='choice' class='tblselect'>
        <option value="email">Email</option>
        <option value="ssn">SSN</option>
        <option value="username">UserName</option>
    </select>
</div>
<script>/*$("#tblsearch").keyup(function() {

    //search_table($(this).val());
    var searchFor = $(this).val();
    var selected = $("#choice")
      .children("option:selected")
      .val();
    $.ajax({
      method: "POST",
      url: "../pages/usersTable.php",
      data: { search: searchFor, by: selected },
      success: function(msg) {
        $("#ajaxTable").html(msg);
      }
    });
  });*/</script>
<!--<div id='ajaxTable'>-->
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
        <th>Doc</th>
        <th>Status</th>
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
        on emp_id=id where employee.active = 1 AND privilege = 'user' AND active = 1 AND accepted <> 2
        ";
    try
    {
        $DB->query($sql);
        $DB->execute();
        $y=0;
        if($DB->numRows()>0)
        {   
            $x=$DB->getdata();
            for($i=0;$i<$DB->numRows();$i++)
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
                if($x[$i]->accepted == 1)
                {
    ?>
    <td><input type='submit' class='modify' value ='+QC'></td>
    <td><input type='submit' class='modify' value ='+HR'></td>
    <td><a href="../operations/DeleteTable.php?id=<?php echo $x[$i]->id; ?>" class='deleteConfirmation EditBtn'>Delete</a></td>

    <?php

                    echo "<td><a href='../pages/profile.php?id={$x[$i]->id}' class='EditBtn'>Profile</a></td>";
                    echo "<td><a href='../pages/pn.php?id={$x[$i]->id}' class='EditBtn'>Doc</a></td>";
                    echo "<td><a id='button-accepted'>Accepted</a></td>";
                }
                else if($x[$i]->accepted == 0)
                {
                    echo "<td></td>";
                    echo "<td></td>";
                    ?>
                    <td><a href="../operations/DeleteTable.php?id=<?php echo $x[$i]->id; ?>" class='deleteConfirmation EditBtn'>Delete</a></td>
                    <?php
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><a id='button-rejected'>Rejected</a></td>";
                }

                echo "</tr>";
            }
        }
        else if($DB->numRows() ==0)
        {
          echo "<tr><td colspan=12 >No Data to show</td></tr>";
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
        error_log("error while getting main table data");
    }

    ?>
</table>

<?php
include "../template/footer.php"; ?>