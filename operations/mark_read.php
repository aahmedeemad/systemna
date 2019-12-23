<?php
$pageTitle = "SYSTEMNA | Mark Read OP";
include "../template/header.php";
?>
	<?php
	$uid = $_SESSION['id'];
	$sql = " UPDATE notifications SET status = 1 WHERE userid = $uid AND status = 0 ";
	$DB->query($sql);
	$DB->execute();
	?>;
<?php include "../template/footer.php"; ?>