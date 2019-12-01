<style>
	#newsearch{
		float:right;
		padding:0.5em;
	}
	.stextinput{
		margin: 0;
		padding: 0.5em;
		font-size: 0.7em;
		border: 0.1em solid #DAA520;
		border-right: 0px;
		border-top-left-radius: 0.5em 0.5em;
		border-bottom-left-radius: 0.5em 0.5em;
	}
	.sbutton {
		margin: 0;
		padding: 0.5em;
		margin-right: 0.8em;
		font-size: 0.7em;
		outline: none;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		color: #ffffff;
		border: solid 0.1em #DAA520;
		border-right: 0px;
		background: #DAA520;
		border-top-right-radius: 0.5em 0.5em;
		border-bottom-right-radius: 0.5em 0.5em;
	}
</style>

<body>
	<div>
		<form id="newsearch" method="post">
		        <input type="text" id="searched" class="stextinput" size="21" maxlength="120"><input type="submit" name="submit" value="search" class="sbutton" onclick="search()">
		</form>
	</div>
	<script>
		function search() {
			alert("Betdawar 3ala " + document.getElementById("searched").value + " ezay ?\nEktb el code bta3 el search el awl ya 7aywan");
		}
</script>
</body>