<?php
$pageTitle = "SYSTEMNA | Add Question";
include "../template/header.php";
?>
<div id="thefn">
	<?php
	$uid = $_SESSION['id'];
	$sql = " UPDATE notifications SET status = 1 WHERE userid = $uid AND status = 0 ";
	$DB->query($sql);
	$DB->execute();
	?>;
</div>
<?php include "../template/footer.php"; ?>