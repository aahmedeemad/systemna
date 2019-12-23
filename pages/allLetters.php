<?php
$pageTitle = "SYSTEMNA | Letters";
include "../template/header.php"; 
?>
<?php if($_SESSION['type']=='user') header('Location:lettertypes.php'); ?>

<?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){echo('<div style="text-align: center; align-self: center;"><div style="align: center;" class="pages_edit" id="add_letter" onclick="addletter.send()"></div></div>');}?>
<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>Name</th>
        <th>Desc</th>
        <th>Edit</th>
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
        FROM requests_types
              ";
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
                //                print_r($x);
                $y++;
                $id=$x[$i]->Type_id;
                $name=$x[$i]->Name;
                $desc=$x[$i]->description;
                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "<div><td>{$name}</td></div>
                <div><td>{$desc}</td></div>";

                //<td ><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
    ?>
    <td><a type='submit' href="AddNewLetter.php?id=<?php echo $id ;?>" class='EditBtn'>Edit</a></td>
    <td><a type='submit' onclick="return confirm('Delete this letter?')"
           href="../operations/DeleteTable.php?lid=<?php echo $id ;?>" class='EditBtn'>Delete</a></td>

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