<?php
$pageTitle = "SYSTEMNA | Letters";
include "../template/header.php";
?>
<?php if($_SESSION['type']=='user') header('Location:lettertypes.php'); ?>

<!-- ADD "Add new type of letter if Admin(hr) -->
<?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){echo('<div style="text-align: center; align-self: center;"><div class="pages_edit" id="add_letter">Add new type of letter</div></div>');}?>

<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>Name</th>
        <th>Desc</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php
    //    function check($c){
    //        if($c==null)
    //            $c='-';
    //        else if($c=='')
    //            $c='-';
    //        return $c;
    //    }

    $sql="SELECT *FROM requests_types ";
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
                $id=$x[$i]->Type_id;
                $name=$x[$i]->Name;
                $desc=$x[$i]->description;
                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "
                <td><div>{$name}</div></td>
                <td><div>{$desc}</div></td>
                ";
                //<td ><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
    ?>
    <td><a href="AddNewLetter.php?id=<?php echo $id ;?>" class='EditBtn'>Edit</a></td>

    <td>
        <a id="lid=<?php echo $id ;?>" href="../operations/DeleteTable.php" class='deleteConfirmation EditBtn'>Delete</a>
    </td>
    <?php
                echo "</tr>";
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        error_log("Error while trying to open page all letters");
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    }

    ?>
</table>

<?php include "../template/footer.php"; ?>
