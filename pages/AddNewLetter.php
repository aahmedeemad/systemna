<?php
ob_start();
$pageTitle = "SYSTEMNA | Add Letter";
include "../template/header.php";
if($_SESSION['type']=='user') header('Location:MakeLetter.php');

if(isset($_GET['id'])){

    $sql="SELECT * FROM requests_types WHERE type_id =" . $_GET['id'];
    $DB->query($sql);
    $DB->execute();
    $x = $DB->getdata();
?>

<h3> Edit Letter </h3>
<hr>

<div>
    <form id="Addquestionform" method='post' action="../operations/newLetter.php">
        <input type="hidden" name="id" class="hidden" value="<?php echo $x[0]->Type_id; ?>">
        <h4>Letter Name: </h4>
        <input type="text" id="Name" name="Name" placeholder="new letter name.." value="<?php echo $x[0]->Name; ?>" required>
        <br>
        <h4>Letter description: </h4>
        <textarea id="description1" name="description" placeholder="description of the new letter.." required><?php echo $x[0]->description; ?></textarea>
        <br>
        <br>
        <br>
        <br>
        <input type="submit" name="updateLetter" id="updateLetter" value="Update Letter">
    </form>
</div>

<?php } else { ?>

<h3> Add New Type of Letter </h3>
<hr>

<div>

        <h4>Letter Name: </h4>
        <input type="text" id="Name" name="Name" placeholder="new letter name.." >
        <h4>Letter description : </h4>
         <textarea id="description" name="desc." placeholder="description of the new letter.."  ></textarea>
        <br>
        <h4>Letter body: </h4>

        <p style="background-color:#dcdc6f">Please paste the letter body template and type NAME in capital letters where the employee name should be placed same thing with SALARY , POSITION ,DATE,START and name of hr as HRNAME. <br> Note:put in consederation that salary is going to be replaced with 'their current gross salary is EGP [amount] per annum.'  </p>


        <textarea  rows="20"  id="body" name="body"  style="width:100%;" onkeyup="changetext()" placeholder="body of the new letter.." ></textarea>

        <br>
        <br>
        <br>
        <br>
        <input type="button" class="btn btn-info btn-sml" data-toggle="modal" data-target="#exampleModalLong" value="view letter">
        <input type="button" name="addLetter" id = "AddLetterbtn" onclick="senddata()" value="Add Letter">

</div>






<!--//view letter before saving not finished yet.-->



<!--<div class="modal fade bd-example-modal-xl" tabindex="-1" id="exampleModalLong" role="dialog">
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
                  <pre>

                   <b>hello</b>
                   <br>
                    this is a letter for fady
                         sincerly,
                            hr tram

            </pre>
</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" >ok</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>-->






<script>

    function changetext(){
        var text= document.getElementById('body').value;
        var n= text.includes('NAME');
        var s= text.includes('SALARY');
        var d= text.includes('DATE');
        var p= text.includes('POSITION');
        var startdate=text.includes('START');
        if(n==true && !text.includes("(.NAME.)")){
            text=text.replace('NAME',"(.NAME.) ");
            document.getElementById('body').value=text;

        }

        if(s==true && !text.includes("(.SALARY.)")){
            text=text.replace('SALARY',"(.SALARY.)");
            document.getElementById('body').value=text;

        }


        if(d==true && !text.includes("(.DATE.)")){
            text=text.replace('DATE',"(.DATE.) ");
            document.getElementById('body').value=text;

        }  if(p==true && !text.includes("(.POSITION.)")){
            text=text.replace('POSITION',"(.POSITION.) ");
            document.getElementById('body').value=text;

        }  if(startdate==true && !text.includes("(.START.)")){
            text=text.replace('START',"(.START.) ");
            document.getElementById('body').value=text;

        }

    };



</script>

<script>
function senddata(){
  var dataa=document.getElementById('body').value;
    dataa='<pre>'+dataa+'</pre>';
   if (dataa.includes('(.NAME.)') && dataa.includes('(.SALARY.)') && dataa.includes('(.DATE.)')){
    jQuery.ajax({

        url: "../operations/newLetter.php",
        data:'body='+dataa+'&Name='+$("#Name").val()+'&description='+$("#description").val(),
        type:"POST",

            success:function(data)
        {
            alert(data);
        }


    });
} else {

    alert('please fill name,salary and date');
}
}
</script>

<script src="../js/bootstrap.min.js"></script>


<link rel="stylesheet" href="../css/bootstrap.min.css">

<?php
}
ob_end_flush();
include "../template/footer.php";
?>
