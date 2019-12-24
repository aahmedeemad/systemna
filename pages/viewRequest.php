<?php
$pageTitle = "SYSTEMNA | Requested Letters";
include "../template/header.php";
?>

<br>
<div style="text-align: center;">
    <h1 style="font-family: sans-serif;">Your Requests</h1>
</div>
<br><br>
<table id='Display'>
    <tr id='must'>
        <th>#</th>
        <th>Request ID</th>
<!--        <th>Employee ID</th>-->
        <th>Status</th>
        <th>Applied for Letter</th>
        <th>Priority</th>
        <th>Salary</th>
        <th>Date applied for</th>
        <th colspan="3">Actions</th>
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
    on requests.type_name=requests_types.Name where emp_id='".$_SESSION['id']."'";
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
                $date=check($x[$i]->date);
                $type_name=$x[$i]->type_name;


                $Boolsalray = "Without Salary";
                $BoolPriority = "Urgent";

                if($salary == 1)
                {
                    $Boolsalray ="With Salary";
                }
                else $Boolsalray ="Without Salary";

                if($priority == 1)
                {
                    $BoolPriority ="Urgent";
                }
                else $BoolPriority="Normal";

                echo  "<tr>";
                echo "<td>{$y}</td>";

                echo "<td>{$id}</td>";
//                echo "<td>$emp_id</td>";


                if($x[$i]->Status==1){
                    echo "<td style='color:green; font-weight:bold;'>Accepted</td>";}
                else if($x[$i]->Status==0){
                    echo "<td style='color:red; font-weight:bold;' >Rejected</td>";}
                else{
                    echo "<td style='color:#be800d; font-weight:bold;' >Pending</td>";
                }
                echo "<td>{$type_name}</td>";
                echo "<td>{$BoolPriority}</td>";
                echo "<td>{$Boolsalray}</td>";
                /*

    if($x[$i]->priority==1){
    echo "<td>Urgent</td>";}
    else{
    echo "<td>Normal</td>";}

    if($x[$i]->salary==0){
    echo "<td>With Salary</td>";}
    else{
    echo "<td>Without Salary</td>";}
    */
                echo "<td>$date</td>";
                if($x[$i]->Status==1){
    ?>

    <td colspan="2"><button class="btn btn-info btn-sml" data-toggle="modal" data-target="#myModal">view letter</button></td>
    <td colspan="2"><button class="btn btn-info btn-sml" data-toggle="modal" data-target="#myModal">get by mail</button></td>


    <?php } else if ($x[$i]->Status==0){
    ?>

    <td colspan="2"><p style="color:red; font-weight:bold;">Rejected</p></td>

    <?php }


                else   {
    ?>

    <td colspan="2"><a type='submit' onclick="return confirm('Delete this Request?')"
           href="../operations/deleterequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn'>Delete</a></td>

    <td colspan="2"><a type='submit' onclick="return confirm('Edit this Request?')"
           href="../pages/editLetter.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn1'>Edit</a></td>
    </tr>

<?php
                }
            }
            /*else
                 echo "<td></td>";
                  echo "<td></td>";
*/

        }
        else {
            echo"<tr><td colspan=9>You have no requests for now ! </td></tr>";
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
    }

?>
</table>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">letter content</h4>
            </div>
            <div class="modal-body" id="body">
                <h1  align='center'>astkly for fruit scented astyks </h1> <h2 align='center' > A new generation of asatyk </h2> <h3 align='center'> we make it you smell it. </h3> <br> this is an hr letter for an emplyee. <br> cheers.
            </div>
            <div class="modal-footer">
                <div type="button" class="btn btn-default" data-dismiss="modal" onclick="Export2Doc('body')">download</div>
            </div>
        </div>

    </div>
</div>


<script src="../js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script>


    function Export2Doc(element, filename = ''){
        var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
        var postHtml = "</body></html>";
        var html = preHtml+document.getElementById(element).innerHTML+postHtml;

        var blob = new Blob(['\ufeff', html], {
            type: 'application/msword'
        });

        // Specify link url
        var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

        // Specify file name
        filename = filename?filename+'.doc':'document.doc';

        // Create download link element
        var downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if(navigator.msSaveOrOpenBlob ){
            navigator.msSaveOrOpenBlob(blob, filename);
        }else{
            // Create a link to the file
            downloadLink.href = url;

            // Setting the file name
            downloadLink.download = filename;

            //triggering the function
            downloadLink.click();
        }

        document.body.removeChild(downloadLink);
    }
</script>
<?php include "../template/footer.php"; ?>
