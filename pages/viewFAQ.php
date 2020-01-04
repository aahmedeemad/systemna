<?php
$pageTitle = "SYSTEMNA | FAQ";
include "../template/header.php";
if($_SESSION['type']!='admin') header('Location:MakeLetter.php'); 
?>

<div style="text-align: center; align-self: center;">
    <div class="pages_edit" id="faq_add">Add Question</div>
</div>
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
    function check($c){//check if value is empty so it gets replaced with a dash
        if($c==null)
            $c='-';
        else if($c=='')
            $c='-';
        return $c;
    }

    $sql="
        SELECT *
        FROM faq
              ";// select all faqs
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
                     <td><div>{$question}</div></td>
                     <td><div>{$answer}</div></td>
                      <td>{$req_by}</td>
                      <td>{$add_by}</td>";

                //<td ><div class='sal' id={$x[$i]->id}>{$salary}</div></td>";
    ?>
    <td><a href="EditFAQ.php?id=<?php echo $id ;?>" class='EditBtn'>Edit</a></td>

    <td>
        <a class="deleteConfirmation EditBtn" id="qid=<?php echo $id ;?>" href="../operations/DeleteTable.php">Delete</a>
    </td>



    <?php
                echo "</tr>";
            }
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        error_log("Error while viewing faqs");
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    }

    ?>
</table>

<?php include "../template/footer.php"; ?>
