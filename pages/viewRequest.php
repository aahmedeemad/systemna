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
    /*function check($c){
        if($c==null)
            $c='-';
        else if($c=='')
            $c='-';
        return $c;
    }*/

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
                $priority=$x[$i]->priority;
                $salary=$x[$i]->salary;
                $date=$x[$i]->date;
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

                echo "<td>$date</td>";
                if($x[$i]->Status==1){
    ?>

    <td colspan="2"><button id='<?php echo $x[$i]->type_name;?>' onclick="showdata(this.id,'<?php echo $x[$i]->salary;?>' ,'<?php echo $x[$i]->date;?>','<?php echo $id; ?>')" class="btn btn-info btn-sml" data-toggle="modal" data-target='#exampleModalLong'>view letter</button></td>


    <?php } else if ($x[$i]->Status==0){
    ?>

    <td colspan="2"><p style="color:red; font-weight:bold;">Rejected</p></td>

    <?php }


                else   {
    ?>

    <td colspan="2"><a href="../operations/deleterequest.php?id=<?php echo $x[$i]->Request_id ;?> " class='deleteConfirmation EditBtn'>Delete</a></td>

    <td colspan="2"><a href="../pages/editLetter.php?id=<?php echo $x[$i]->Request_id ;?> " class='EditBtn1'>Edit</a></td>


    <?php
                    echo "</tr>";
                }
            }
          
        }
        else {
            echo"<tr><td colspan=9>You have no requests for now ! </td></tr>";
        }
    }
    catch(Exception $e)
    {
        $_SESSION['error'] = 'error in sql';
        error_log("Error while user trying to view letter request");
        echo "<br><div class='alert alert-danger' style='text-align: center;'>ERROR! Please try again later</div>";
    }

    ?>
</table>





<div class="modal fade bd-example-modal-xl" tabindex="-1" id="exampleModalLong" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Letter View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="body">
                <div>
                    <p>sorry something went Wrong</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Export2Doc('body')">download</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    function showdata(id,salary,date,request_id){
        jQuery.ajax({
            url: "view_letter.php",
            data:'id='+id+'&salary='+salary+'&date='+date+'&request_id='+request_id,
            type:"POST",

            success:function(data)
            {
                $("#body").html(data);


            }
        });
    }
</script>


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
    /*
    function pdf(){
        var doc = new jsPDF();
        var elementHTML = document.getElementById('body').innerHTML;
        var specialElementHandlers = {
            '#elementH': function (element, renderer) {
                return true;
            }
        };
        doc.fromHTML(elementHTML, 15, 15, {
            'width': 170,
            'elementHandlers': specialElementHandlers
        });

        // Save the PDF
        doc.save('sample-document.pdf');
    }*/
</script>

<script src="../js/bootstrap.min.js"></script>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<?php include "../template/footer.php"; ?>
