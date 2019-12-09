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
	#faqdiv span
	{
		text-decoration: underline;
		background-color: #DAA520;
	}
</style>

<body>
	<div>
		<form id="newsearch">
		        <input type="text" id="searched" class="stextinput" size="21" maxlength="120"><input type="submit" id="submit" value="search" class="sbutton">
		</form>
	</div>
	<script>
		$('#searched').keyup(function(){
			var page = $('#faqdiv');
			var pageText = page.text().replace("<span>","").replace("</span>");
			var searchedText = $('#searched').val();
			var theRegEx = new RegExp("("+searchedText+")", "igm");
			var newHtml = pageText.replace(theRegEx ,"<span>$1</span>");
			page.html(newHtml);
		});
	</script>
</body>