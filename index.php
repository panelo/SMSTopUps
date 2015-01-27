<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AJAXIFY TransferTo 1.0</title>
<link rel="stylesheet" href="css/ajaxit.css" type="text/css" media="all" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<script type="text/javascript" src="scripts/jquery.autocomplete.js"></script>
<script type="text/javascript">
/*
$(document).ready(function(){
    $("#loading").bind("ajaxSend", function() {
        $(this).show();
    }).bind("ajaxStop", function() {
        $(this).hide();
    }).bind("ajaxError", function() {
        $(this).hide();
	});
});
*/

var options = {
	resetForm: true
};

$(function(){
	$("#FormRepeatLink").hide();
	$("#FormTopUpLink").hide();
	$("#detailsnext").hide();
	$("#ajaxform").click(function(){
		$("#dn").autocomplete( "search", "" );
		$("#FormRepeat").hide("slow");
		$("#FormRepeatLink").show("slow");
		$('#content_data').ajaxForm(options);
	});
	$("#repeatform").click(function(){
		$("#FormTopUp").hide("slow");
		$("#FormTopUpLink").show("slow");
	});
	$("a.repeat").click(function(){
		$("#FormRepeat").show("slow");
		$("#FormTopUpLink").show("slow");
		$("#FormTopUp").hide("slow");
		$("#FormRepeatLink").hide("slow");
		$('#content_data').ajaxForm(options);
	});
	$("a.topup").click(function(){
		$("#FormRepeat").hide("slow");
		$("#FormTopUpLink").hide("slow");
		$("#FormTopUp").show("slow");
		$("#FormRepeatLink").show("slow");
		$('#content_data').ajaxForm(options);
	});
	$("body").click(function(){
		if( $("#dn").val() == ' +' || $("#dn").val() == '' || $("#dn").val().length <= 3 ) {
			$("#details").hide();
			$('#target').keydown(function() {
  				$("#dn").val() == ' +';
			})
		}
		else {
			$("#details").show("slow");	
		}
		$("#detailsnext").show("slow");
	});
	$('#find').click(function() {
		$('#dn').keydown();
	});
	$('#dn').blur(function(){
		$('#dn').focus();
		$('#dn').blur(); 
	});
});

$(function() {
	$("#ajaxform").submit(function() {
		var msisdn = $("#dn").val();
		var dataString = 'msisdn='+ msisdn;
		
		if(msisdn=='')
		{
			alert("Please enter the Number");
		}
		else
		{
			$("#loading").bind("ajaxSend", function() {
		        $(this).show();
			}).bind("ajaxStop", function() {
				$(this).hide();
			}).bind("ajaxError", function() {
				$(this).hide();
			});
			$('#loading').show();
			$.ajax({
				type: "GET",
				url: "topup.php",
				data: dataString,
				success: function(response){
					$("#FormRepeat").hide();
					$("#FormRepeatLink").hide();
					$("#FormTopUp").hide();
					$("#FormTopUpLink").hide();
					$('#content_data').fadeIn(200).show();
					$('#content_data').html(response);
				}	
			});
		}
		return false;
	});
});

$(function() {
	$("#repeatform").submit(function() {
		var transactionid = $("#transactionid").val();
		var trans = $("#trans").val();
		var dataString = 'transactionid='+ transactionid + '&trans='+ trans;
		
		if(transactionid=='')
		{
			alert("Please enter the Transaction ID");
		}
		else
		{
			$("#loading").bind("ajaxSend", function() {
		        $(this).show();
			}).bind("ajaxStop", function() {
				$(this).hide();
			}).bind("ajaxError", function() {
				$(this).hide();
			});
			$('#loading').show();
			$.ajax({
				type: "GET",
				url: "topup.php",
				data: dataString,
				success: function(response){
					$("#FormRepeat").hide();
					$("#FormRepeatLink").hide();
					$("#FormTopUp").hide();
					$("#FormTopUpLink").hide();
					$('#content_data').fadeIn(200).show();
					$('#content_data').html(response);
				}	
			});
		}
		return false;
	});
});

$(function() {
    $("#dn").autocomplete({
        url: 'search_countries.php',
        displayValue: function(value, data) {
            return ' +' + $.trim(value.split('-')[0]);
        },
        showResult: function(value, data) {
        	$("#details").html('Country: ' + value.split('-')[1] + '<br /><br />');
            return '<span class="acCountryCode">+' + value.split('-')[0] + '</span> ' + value.split('-')[1];
        },
       	onItemSelect: function(item) {
            $("#details").html('Country: ' + item.value.split('-')[1] + '<br /><br />');
            $("#detailsnext").show("slow");
        },
        sortFunction:function(a, b) { 
        	return b.value - a.value;
        },
        mustMatch:false,
        filterResults: false,
        useCache: false,
        minChars: 0,
        autoFill: false,
        sortResults:true,
        selectFirst: false
    })
});
</script>
</head>

<div id="loading" style="display:none;">
<p><img src="images/loading.gif" align="absmiddle" /> Please Wait...</p>
</div>

<div id="content_data"></div>

<div id="FormTopUp">
<div class="title">Send a Top-up to this number</div>
<form method="GET" name="ajaxform" id="ajaxform" action="topup.php">
<span class="ac_holder">
<label for="number">Number</label> <input style="width: 200px" type="text" id="dn" name="dn" value=" +" autocomplete="off" /> <a href="#" id="find" onClick="javascript:document.getElementById('dn').focus();document.getElementById('dn').value=' +';">find country code</a>
</span>
<div id="details"></div>
<div id="detailsnext"><input type="submit" class="ajaxform" value=" Next " /></div>
</form>
</div>

<div id="FormRepeat">
<div class="title">Repeat a transaction</div>
<form method="post" name="repeatform" action="topup.php" id="repeatform">
<label for="transact">Transaction ID</label> <input type="text" id="transactionid" name="transactionid" />
<input type="hidden" id="trans" name="trans" value="1" />
<input type="submit" class="repeatform" value=" Next " />
<div id="error" style="display:none;">Invalid Data</div>
</form>
</div>

<div id="FormTopUpLink">
<hr />
<a href="#" title="Send a Top-up" class="topup">Or send a Top-up</a>
</div>

<div id="FormRepeatLink">
<hr />
<a href="#" title="Repeat a transaction" class="repeat">Or repeat a transaction</a>
</div>

</body>
</html>