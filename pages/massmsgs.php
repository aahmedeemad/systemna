<?php 
$pageTitle = "SYSTEMNA | Mass Messaging";
include "../template/header.php"; ?>
<style>
	.vertical {
		display: block;
		border-left: 0.5vw solid #daa520;
		height: 89vh;
	}
	.horizontal {
		display: none;
		border-bottom: 1vw solid #daa520;
		width: 99.5vw;
	}
	@media screen and (max-width: 800px) {
		.vertical {
			display: none;
		}
		.horizontal {
			display: block;
			padding-top: 5em;
		}
		table td {
			display: inline-block;
		}
</style>

<table style="width: 100%;">
	<tr>
		<td>
			<div>
				<h3>Send notification:</h3>
				<br>
				<label><input type="radio" name="Option1" id ="rdbtn1"> Send notification to one user</label>
				<br>
				<label><input type="radio" name="Option1" id ="rdbtn2"> Send notification to all users</label>
				<br>	
			</div>
			<br>
			<div id="notione">
				Select the user id/name: [Drop down box b user names mn db]
			</div>
			<div id="notiall">
				Select the user id/name: [for loop 3ala kol el user names mn db]
			</div>
			<br>
			Write the notification content:<br><br>
			<textarea name="notification" rows="8" cols="50" class="massmsgfield" required></textarea>
			<br><br>
			<input type="submit" class="massmsgsendbtn" value="Send">
		</td>
		<td><div class = "vertical"></div><div class = "horizontal"></div></td>
		<td>
			<div>
				<h3>Send mail:</h3>
				<br>
				<label><input type="radio" name="Option1" id ="rdbtn1"> Send mail to one user</label>
				<br>
				<label><input type="radio" name="Option1" id ="rdbtn2"> Send mail to all users</label>
				<br>
			</div>
			<br>
			<div id="mailone">
				Select the user id/name/email: [Drop down box b user names and emails mn db]
			</div>
			<div id="mailall">
				Select the user id/name: [for loop 3ala kol el user emails mn db]
			</div>
			<br>
			write and show "from" name (automatic mn session esm el admin + from systemna)
			<br>
			Write the mail subject:<br><br>
			<input type="text" class="massmsgfield" required>
			<br><br>
			Write the mail content:<br><br>
			<textarea name="notification" rows="8" cols="50" class="massmsgfield" required></textarea>
			<br><br>
			<input type="submit" class="massmsgsendbtn" value="Send">
		</td>
	</tr>
</table>

<?php include "../template/footer.php"; ?>