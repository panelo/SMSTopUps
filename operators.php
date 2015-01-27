<script type="text/javascript">
$(function() {
    $("#dn").autocomplete({
        url: 'search_countries.php',
        displayValue: function(value, data) {
            return ' +' + $.trim(value.split('-')[0]);
        },
        showResult: function(value, data) {
            return '<span class="acCountryCode">+' + value.split('-')[0] + '</span> ' + value.split('-')[1];
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
					//$('#content_data').fadeIn(200).show();
					$('#content_data').html(response);
				}	
			});
		}
		return false;
	});
});

$(function() {
	$("#operid").submit(function() {
		var msisdn = $("#dn").val();
		var new_operator = $("#new_operator").val();
		var dataString = 'msisdn='+ msisdn + '&operatorid='+ new_operator;
		
		if(msisdn=='')
		{
			alert("Invalid Transaction");
		}
		else
		{
			$('#loading').show();
			$.ajax({
				type: "GET",
				url: "topup.php",
				data: dataString,
				success: function(response){
					$("#FormTopUpLink").hide();
					$("#FormTopUp").hide();
					//$('#content_data').fadeIn(200).show();
					$('#content_data').html(response);
				}	
			});
		}
		return false;
	});
	/*
	$(function () {
		$("#new_operator").live("change keyup", function () {
			$("#operid").submit();
			$("#loading").bind("ajaxSend", function() {
		        $(this).show();
			}).bind("ajaxStop", function() {
				$(this).hide();
			}).bind("ajaxError", function() {
				$(this).hide();
			});
			$('#loading').show();
		});
	});
	*/
});
</script>

<?php
//START CONNECTION STRING ---------------------------------
mysql_connect("localhost","paneloc_ajaxify","ajaxify12345") or die(mysql_error());
mysql_select_db("paneloc_ajaxify") or die(mysql_error());
//END CONNECTION STRING -----------------------------------


if ($_REQUEST["cdn"]=="1") {
	echo "<form method='GET' name='ajaxform' id='ajaxform' action='topup.php'>";
	echo "<input style='width: 175px' type='text' id='dn' name='dn' value=' +".$_REQUEST["dn"]."' />";
	echo "<input type='submit' class='ajaxform' value=' Save ' />";
	echo "</form>";
}
else {
	$cid = $_REQUEST["cid"];
	$dn = $_REQUEST["dn"];
	$results = mysql_query("select * from numbering_plan where countryid = '".$cid."' order by country") or die(mysql_error()); 
	echo "<form method='GET' name='operid' id='operid' action='topup.php'>";
	echo "<select name='new_operator' id='new_operator'>";
	while ($rows = mysql_fetch_array($results)) {
	
		echo "<option value='".$rows["operatorid"]."'>".$rows["operator"]."</option>";
	}
	echo "</select>";
	echo "<input type='hidden' id='dn' name='dn' value='".$dn."' />";
	echo "<input type='submit' class='operid' value=' Save ' />";
	echo "</form>";
}

?>