<?php
$pageTitle = "SYSTEMNA | Add Letter";
include "../template/header.php";
if($_SESSION['type']!='admin') header('Location:MakeLetter.php');

if(isset($_GET['id']) && $_GET['id'] != 1){
    $sql="SELECT * FROM requests_types WHERE type_id =" . $_GET['id'];
    $DB->query($sql);
    $DB->execute();
    $x = $DB->getdata();
    $addition=$x[0]->additional_info;
    if($addition=='0'){
        $addition="";
    }
?>

<h3> Edit Letter </h3>
<hr>

<h4>Letter Name: </h4>
<input id="id" type="hidden" value="<?php echo $x[0]->Type_id;?>">
<input type="text" id="Name" name="Name" placeholder="new letter name.." value="<?php echo $x[0]->Name;?>" >
<h4>Letter description : </h4>
<textarea id="description" name="desc." placeholder="description of the new letter.."  ><?php echo $x[0]->description; ?></textarea>
<h4>aditional info : </h4>
<p style="background-color:#dcdc6f; padding: 6px; color:grey;">Please add a valid WH question if required for additional info with question mark and caps down or leave empty. </p>
<input type="text" style="width:100%" id="add_info" name="add_info" placeholder="add_info (optional)" value="<?php echo $addition; ?>" >

<br>
<h4>Letter body: </h4>

<p style="background-color:#dcdc6f; padding: 6px; color:grey;">Please paste the letter body template and type NAME in capital letters where the employee name should be placed same thing with SALARY , POSITION ,DATE,START and Additional info if exists as ADDITIONAL <br> Note: Put in consederation that salary is going to be replaced with 'their current gross salary is EGP [amount] per annum.'  </p>


<textarea  rows="20"  id="letterBodyArea" name="body"  style="width:100%;" placeholder="body of the new letter.." ><?php echo filter_var($x[0]->body, FILTER_SANITIZE_STRING); ?></textarea>

<br><br><br><br>
<input type="button" name="updateLetter" id = "UpdateLetterbtn" value="Update Letter">

<?php } else { ?>

<h3> Add New Type of Letter </h3>
<hr>

<h4>Letter Name: </h4>
<input type="text" id="Name" name="Name" placeholder="new letter name.." >
<h4>Letter description : </h4>
<textarea id="description" name="desc." placeholder="description of the new letter.."  ></textarea>
<h4>aditional info : </h4>
<p style="background-color:#dcdc6f; padding: 6px; color:grey;">Please add a valid WH question if required for additional info with question mark and caps down or leave empty. </p>
<input type="text" style="width:100%" id="add_info" name="add_info" placeholder="add_info (optional)" >

<br>
<h4>Letter body: </h4>

<p style="background-color:#dcdc6f; padding: 6px; color:grey;">Please paste the letter body template and type NAME in capital letters where the employee name should be placed same thing with SALARY , POSITION ,DATE,START and Additional info if exists as ADDITIONAL <br> Note: Put in consederation that salary is going to be replaced with 'their current gross salary is EGP [amount] per annum.'  </p>


<textarea  rows="20"  id="letterBodyArea" name="body"  style="width:100%;" placeholder="body of the new letter.." ></textarea>

<br><br><br><br>
<input type="button" name="addLetter" id = "AddLetterbtn" value="Add Letter">





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

<?php
}
include "../template/footer.php";
?>
