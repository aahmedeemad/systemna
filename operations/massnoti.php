<?php
$pageTitle = "SYSTEMNA | Mass Notification OP";
include "../template/header.php";
?>

<script>
	$(document).ready(function () {

		function sendnotiall(){
			<?php
			$sql = "SELECT * FROM employee";
			$DB->query($sql);
			$DB->execute();
			$x=$DB->getdata();
			$y=$DB->numRows();
			for ($i=0; $i<$y; $i++) {
				if (isset($_POST['notification'])) {
					$notification=filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
					$uid=$x[$i]->id;
					$sql2="INSERT INTO notifications (status, userid, notidata) VALUES ('0','$uid','$notification')";
					$DB->query($sql2);
					$DB->execute();
				}
			}
			?>
		};

		function sendnotione(){
			var selectedusr = document.getElementById("notione");
			var uid = selectedusr.options[selectedusr.selectedIndex].value;
			<?php
			$sql = "SELECT * FROM employee";
			$DB->query($sql);
			$DB->execute();
			$x=$DB->getdata();
			$y=$DB->numRows();
			if (isset($_POST['notification'])) {
				$notification=filter_var($_POST['notification'], FILTER_SANITIZE_STRING);
				$sql2="INSERT INTO notifications (status, userid, notidata) VALUES ('0','$uid','$notification')";
				$DB->query($sql2);
				$DB->execute();
			}
			?>
		};

	});
</script>

<?php include "../template/footer.php"; ?>