<?php
$pageTitle = "SYSTEMNA | FAQ";
include "../template/header.php"; 
?>
<?php if(!isset($_SESSION['username'])){header('Location:../index.php');}
 if($_SESSION['type']=='user'){header('Location:lettertypes.php');}    ?>
<br>

<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th></th>
        <th>ID</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Requested By</th>
        <th>Added By</th>
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
        FROM faq
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
                $y++;
                $id=$x[$i]->ID;
                $question=$x[$i]->Question;
                $answer=$x[$i]->Answer;
                $req_by=check($x[$i]->Requested_by);
                $add_by=check($x[$i]->Added_by);
                echo  "<tr>";
                echo "<td>{$y}</td>";
                echo "<td></td>";
                echo "<td>{$id}</td>
                     <div><td>{$question}</td></div>
                     <div><td>{$answer}</td></div>
                      <td>{$req_by}</td>
                      <td>{$add_by}</td>";

                //<td ><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
                ?>
    <td><a type='submit' onclick="return confirm('Delete this account?')"
            href="../operations/DeleteTable.php?id=<?php echo $x[$i]->id ;?>" class='EditBtn'>Edit</a></td>
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