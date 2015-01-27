<script type="text/javascript">
var options = {
	resetForm: true
};

$(function(){
	$("a.index").click(function(){
		page=$(this).attr("href");
		$("#content_data").html(' ').load(page);
		return false
	})
})

$(function(){
	$("a.review").click(function(){
		$("#loading").bind("ajaxSend", function() {
	        $(this).show();
		}).bind("ajaxStop", function() {
			$(this).hide();
		}).bind("ajaxError", function() {
			$(this).hide();
		});
		$('#loading').show();
		page=$(this).attr("href");
		$("#content_data").html(' ').load(page);
		return false
	})
})

$(function(){
	$("a.topup").click(function(){
		page=$(this).attr("href");
		$("#content_data").html(' ').load(page);
		return false
	})
})

$(function(){
	$("a.change_amount").click(function(){
		page=$(this).attr("href");
		$("#content_data").html(' ').load(page);
		$("#loading").bind("ajaxSend", function() {
	        $(this).show();
		}).bind("ajaxStop", function() {
			$(this).hide();
		}).bind("ajaxError", function() {
			$(this).hide();
		});
		$('#loading').show();
		return false
	})
})

$(function(){
	$("a.repeat_try").click(function(){
		page=$(this).attr("href");
		$("#FormRepeat").show("slow");
		$("#FormRepeatLink").hide();
		$("#FormTopUp").hide();
		$("#FormTopUpLink").show("slow");
		$("#content_data").hide();
		//$("#content_data").html(' ').load(page);
		return false
	})
})

$(function(){
	$("a.topup_try").click(function(){
		page=$(this).attr("href");
		$("#FormRepeat").hide();
		$("#FormRepeatLink").show("slow");
		$("#FormTopUp").show("slow");
		$("#FormTopUpLink").hide();
		$("#content_data").hide();
		//$("#content_data").html(' ').load(page);
		return false
	})
})

$("a.change_op").click(function(){
	page=$(this).attr("href");
	$("#loading").bind("ajaxSend", function() {
        $(this).show();
	}).bind("ajaxStop", function() {
		$(this).hide();
	}).bind("ajaxError", function() {
		$(this).hide();
	});
	$('#loading').show();
	$("#change_operator").html(" ").load(page);
	return false
})

$("a.change_dn").click(function(){
	page=$(this).attr("href");
	$("#change_msisdn").html(" ").load(page);
	return false
})

$(function() {
    $("#sm").autocomplete({
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
    });
    $("#loading").bind("ajaxSend", function() {
        $(this).hide();
	}).bind("ajaxStop", function() {
		$(this).hide();
	}).bind("ajaxError", function() {
		$(this).hide();
	});
	$('#loading').hide();
});

$(function() {
	$("#TopUpForm").submit(function() {
		var sm = $("#sm").val();
		var free_text = $("#free_text").val();
		var product = $("#product").val();
		var price = $("#price").val();
		var msisdn = $("#msisdn").val();
		var topup = $("#topup").val();
		var operatorid = $("#operatorid").val();
		
		if (operatorid=="") {
			var dataString = 'sm='+ sm + '&free_text='+ free_text + '&topup='+ topup + '&product='+ product + '&price='+ price + '&msisdn='+ msisdn;
		}
		else {
			var dataString = 'sm='+ sm + '&free_text='+ free_text + '&topup='+ topup + '&product='+ product + '&price='+ price + '&msisdn='+ msisdn + '&operatorid='+ operatorid;
		}
		
		if(sm=='' || sm==' +' || sm==' ' || sm=='+' || sm.length<4)
		{
			alert("Please enter the Sender Number");
		}
		else
		{
			$("#hide_button").hide("slow");
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
					$("#FormRepeatLink").hide();
					$("#content_data").hide();
					$('#FormTopUp').fadeIn(200).show();
					$('#FormTopUp').html(response);
				}	
			});
		}
		$(".change_operator2").html();
		return false;
	});
});
$(function() {
	$("#RepeatTransForm").submit(function() {
		var sm = $("#sm").val();
		var free_text = $("#free_text").val();
		var product = $("#product").val();
		var price = $("#price").val();
		var msisdn = $("#sm").val();
		var topup = $("#topup").val();
		var msisdn = $("#transmsisdn").val();
		var operatorid = $("#operatorid").val();
		if (operatorid=="") {
			var dataString = 'sm='+ sm + '&free_text='+ free_text + '&product='+ product + '&price='+ price + '&msisdn='+ msisdn  + '&topup='+ topup;
		}
		else {
			var dataString = 'sm='+ sm + '&free_text='+ free_text + '&product='+ product + '&price='+ price + '&msisdn='+ msisdn  + '&topup='+ topup + '&operatorid='+ operatorid;	
		}
		if(sm=='' || sm==' +' || sm==' ' || sm=='+' || sm.length<4)
		{
			alert("Please enter the Sender Number");
		}
		else
		{
			$("#hide_button").hide("slow");
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
					$("#FormTopUpLink").hide();
					$("#content_data").hide();
					$('#FormRepeat').fadeIn(200).show();
					$('#FormRepeat').html(response);
				}	
			});
		}
		return false;
	});
});

</script>

<?php
//START CONNECTION STRING ---------------------------------
mysql_connect("localhost","paneloc_ajaxify","ajaxify12345") or die(mysql_error());
mysql_select_db("paneloc_ajaxify") or die(mysql_error());
//END CONNECTION STRING -----------------------------------


//GENERATE RANDOM KEY
function randomkey() {
	$chars = '1234567890';
	for ($p = 0; $p < 10; $p++)
	{
	    $result .= ($p%10) ? $chars[mt_rand(5, 10)] : $chars[mt_rand(0, 7)];
	}
	return $result;
}

$msisdn = str_replace(" ","",$_GET['msisdn']);
$transactionid = str_replace(" ","",$_GET['transactionid']);
$review = $_REQUEST["review"];
$topup = $_GET["topup"];
$trans = $_GET["trans"];

$operatorid = $_REQUEST["operatorid"];
if ($operatorid=="") {
	$operatorid = $_GET["operatorid"];
}

if ($operatorid!="") {
	$inc_operid = "&operatorid=".$operatorid."";
}

//API PARAMS  
$key = randomkey().date('YmdHis');
$login = "johnpanelo";
$password = "KBDkwGucFh";
$md5 = md5($login.$password.$key);

//CALL API
if ($topup=="1" || $topup=="2") {
	$sm = str_replace(" ","",$_GET['sm']);
	if (strlen($sm)<4) {$sm = "8888";}
	$free_text = $_GET["free_text"];
	$enc_free_text = urlencode($free_text);
	$product = $_GET["product"];
	$price = $_GET["price"];
	if ($msisdn=="") {$msisdn = $_REQUEST["msisdn"];}
	$msisdn_info = "http://fm.transfer-to.com/cgi-bin/shop/topup?login=johnpanelo&key=".$key."&md5=".$md5."&msisdn=".$sm."&destination_msisdn=".$msisdn."&product=".$product."&sms=".$enc_free_text."&action=topup&tp_type=tshop".$inc_operid."";
}
elseif ($trans=="1") {
	$msisdn_info = "http://fm.transfer-to.com/cgi-bin/shop/topup?login=johnpanelo&key=".$key."&md5=".$md5."&transactionid=".$transactionid."&action=trans_info";	
	//echo $msisdn_info;
	//exit();
}
else {
	if ($review!="1") {
		$msisdn_info = "http://fm.transfer-to.com/cgi-bin/shop/topup?login=johnpanelo&key=".$key."&md5=".$md5."&destination_msisdn=".$msisdn."&action=msisdn_info".$inc_operid."";
	}
}

if ($review=="1") {
	$product = $_REQUEST["product"];
	$price = $_REQUEST["price"];
	$currency = $_REQUEST["destcur"];
	$operatorname = str_replace("_"," ",$_REQUEST["opname"]);
	$operatorid = $_REQUEST["operatorid"];
	$cid = $_REQUEST["countryid"];
}
else {
	//POPULATE
	$data = file_get_contents($msisdn_info);
	$convert = explode("\n", $data);
	
	//OPERATOR
	$val = explode("=",$convert[2]);
	$opid = explode("=",$convert[3]);
	
	//CURRENCY
	$currency_chunks = explode("=",$convert[5]);
	$currency = $currency_chunks[1];
	
	//PRODUCT LIST
	$product_list_chunks = explode("=",$convert[6]);
	$product_list = substr($product_list_chunks[1],0,-2);
	$product_list = explode(",",$product_list);
	
	//PRICE LIST
	$retail_price_list_chunks = explode("=",$convert[7]);
	$retail_price_list = substr($retail_price_list_chunks[1],0,-2);
	$retail_price_list = explode(",",$retail_price_list);
	
	//COUNTRY ID
	$operid_chunks = explode("=",$convert[1]);
	$cid = $operid_chunks[1];
}

if ($topup=="1" || $topup=="2") {
	$transaction_id_chunks = explode("=",$convert[0]);
	$trx_id = $transaction_id_chunks[1];
	$pin_id_chunks = explode("=",$convert[20]);
	$pin_id = trim($pin_id_chunks[1]);
	$pin_id_det_chunks = explode("=",$convert[25]);
	$pin_id_det = $pin_id_det_chunks[1];
	$currency_chunks = explode("=",$convert[9]);
	$currency = $currency_chunks[1];
	$orig_currency_chunks = explode("=",$convert[8]);
	$orig_currency = $orig_currency_chunks[1];
	$free_text_chunks = explode("=",$convert[16]);
	$free_text = $free_text_chunks[1];
	$op_chunks = explode("=",$convert[5]);
	$op = $op_chunks[1];
	
	$status_err_chunks = explode("=",$convert[2]);
	
	if (ereg("error_code",$status_err_chunks[0])) {
		$status_chunks = explode("=",$convert[3]);
		$err = "1";
	}
	else {
		if ($pin_id=="yes") {
			$status_err_chunks = explode("=",$convert[30]);
			$status_chunks = explode("=",$convert[31]);
		}
		else {
			$status_err_chunks = explode("=",$convert[21]);
			$status_chunks = explode("=",$convert[22]);
		}
	}
	$status = $status_chunks[1];
	$status_err = trim($status_err_chunks[1]);
	
	echo "<div class='title'>Transaction Details</div>";
	echo "<span class='label'>Date: </span><span class='value'>".date('d F Y H:i T')."</span><br />";
	echo "<span class='label'>Trx ID: </span><span class='value'>".$trx_id."</span><br />";
	if ($pin_id=="yes") {
		echo "<span class='label'>PIN: </span><span class='value'>".$pin_id_det."</span><br />";
	}
	echo "<span class='label'>Number: </span><span class='value'>".$msisdn."</span><br />";
	if ($err!="1") {
		echo "<span class='label'>Operator: </span><span class='value'>".$op."</span><br />";
	}
	echo "<span class='label'>Amount: </span><span class='value'>".$product." ".$currency."</span><br />";
	echo "<span class='label'>Price: </span><span class='value'>".$orig_currency." ".$price." </span><br />";
	
	if ($status_err=="0") {
		$stat_val = "value_success";
	}
	else {
		$stat_val = "value_error";
	}
	echo "<span class='label'>Status: </span><span class='".$stat_val."'>".$status."</span><br />";
	echo "<span class='label'>Sender: </span><span class='value'>".$sm."</span>";
	if ($err!="1") {
		echo "<br /><span class='label'>Free Text: </span><span class='value'>".$free_text."</span>";
	}
	echo "<br /><br /><small>For customer service call us at xxxxxxxx or email support@transferto.com</small><br /><br />";
	echo "<form><input type=\"button\" class=\"print\" onClick=\"window.print()\" value=\" PRINT \" /></form>";
	exit();
}
elseif ($review=="1" || $trans=="1") {
	
	if ($trans=="1") {
		$status_chunks = explode("=",$convert[22]);
		$status = $status_chunks[1];
		$free_text_chunks = explode("=",$convert[16]);
		$free_text = $free_text_chunks[1];
		$val = explode("=",$convert[8]);
		$operatorname = trim($val[1]);
		$msisdn_chunks = explode("=",$convert[2]);
		$msisdn = $msisdn_chunks[1];
		$product_chunks = explode("=",$convert[11]);
		$product = $product_chunks[1];
		$price_chunks = explode("=",$convert[14]);
		$price = $price_chunks[1];
		$currency_chunks = explode("=",$convert[21]);
		$currency = $currency_chunks[1];
		$orig_currency_chunks = explode("=",$convert[20]);
		$orig_currency = $orig_currency_chunks[1];
		$country_chunks = explode("=",$convert[7]);
		$cid = trim($country_chunks[1]);
		$operatorname_chunks = explode(" ",$operatorname);
		$val = explode("=",$convert[8]);
		$opid_chunks = explode("=",$convert[9]);
		$operatorid = trim($opid_chunks[1]);
		
		if ($operatorid=="0") {
			//QUERY OPERATOR ID
			$results = mysql_query("select distinct operatorid from numbering_plan where countryid = '".$cid."' and operator like '%".$operatorname_chunks[0]."%' ") or die(mysql_error()); 
			$rows = mysql_fetch_array($results);
			$operatorid = $rows["operatorid"];
		}
		
		$inc_operid = "&operatorid=".$operatorid."";
	}
	
	echo "<div class='title'>Review Transaction</div>";
	
	//ERROR
	if (ereg($convert[2],"error_txt")) {
		echo "<span class='label'>Error:</span><span class='value'>".$val."</span><br />";
		exit();
	}
	
	//ERROR - TRANSACTION NOT FOUND
	if ($status=="" && $trans=="1") {
		echo "<span class='label'>Error:</span><span class='value'>Invalid Transaction ID</span><br />";
		echo "<span class='label'></span><span class='value'><a href='#' class='repeat_try'>Please try Again</a></span><br />";
		exit();
	}
	
	echo "<span class='label'>Number: </span>";
	echo "<span class='valueshort'>";
	echo "<span id='change_msisdn' style='display:inline-block'>";
	echo $msisdn;
	echo "</span>";
	echo "</span>";
	echo "<span class='link'><a href='operators.php?cdn=1&dn=".trim($msisdn)."' class='change_dn'>Edit Number</a></span><br />";
	echo "<span class='label'>Operator: </span>";
	echo "<span class='valueshort'>";
	echo "<span id='change_operator' style='display:inline-block'>";
	
	//CHANGE OPERATOR LOGIC
	if ($operatorid!="" && $_GET["operatorid"]!="") {
		$results = mysql_query("select * from numbering_plan where operatorid = '".$operatorid."'") or die(mysql_error()); 
		$rows = mysql_fetch_array($results);
		$operatorname = $rows["operator"];
		$operatorid = $rows["operatorid"];
	}
	echo $operatorname;
	echo "</span>";
	echo "</span>";
	echo "<span class='link'><a href='operators.php?cid=".$cid."&dn=".$msisdn."' class='change_op'>Change Operator</a></span><br />";
	echo "<span class='label'>Amount: </span><span class='valueshort'>".$product." ".$currency."</span><span class='link'><a href='topup.php?msisdn=".$msisdn."".$inc_operid."' class='change_amount'>Change Amount</a></span><br />";
	echo "<span class='label'>Price: </span><span class='valueshort'>USD ".$price."</span><br /><br />";
	
	if ($trans=="1") {
		echo "<form method=\"GET\" name=\"RepeatTransForm\" id=\"RepeatTransForm\" action=\"topup.php\">";
	}
	else {
		echo "<form method=\"GET\" name=\"TopUpForm\" id=\"TopUpForm\" action=\"topup.php\">";
	}
	echo "<span class=\"ac_holder\">";
	echo "<span class=\"label\">Sender: </span>";
	echo "<input style=\"width: 200px\" type=\"text\" id=\"sm\" name=\"sm\" value=\" +\" />";
	echo "</span>";
	echo "<br />";
	echo "<span class='label'>Free Text: </span>";
	echo "<input style=\"width: 200px\" type=\"text\" id=\"free_text\" maxlength=\"30\" name=\"free_text\" value='' />";
	echo "<br />";
	echo "<span class='label'></span>";
	echo "<input type=\"hidden\" id=\"product\" name=\"product\" value='".trim($product)."' />";
	echo "<input type=\"hidden\" id=\"price\" name=\"price\" value='".trim($price)."' />";
	echo "<input type=\"hidden\" id=\"msisdn\" name=\"msisdn\" value='".trim($msisdn)."' />";
	
	if ($trans=="1") {
		echo "<input type=\"hidden\" id=\"topup\" name=\"topup\" value=\"2\" />";
		echo "<div id='hide_button'><input type=\"submit\" class=\"RepeatTransForm\" value=\" Confirm \" /></div>";
		echo "<input type=\"hidden\" id=\"transmsisdn\" name=\"transmsisdn\" value='".trim($msisdn)."' />";
		echo "<input type=\"hidden\" id=\"operatorid\" name=\"operatorid\" value=\"".$operatorid."\" />";
	}
	else {
		echo "<input type=\"hidden\" id=\"topup\" name=\"topup\" value=\"1\" />";
		echo "<div id='hide_button'><input type=\"submit\" class=\"TopUpForm\" value=\" Confirm \" /></div>";
		if ($operatorid!="") {
			echo "<input type=\"hidden\" id=\"operatorid\" name=\"operatorid\" value=\"".$operatorid."\" />";
		}
	}
	echo "</form>"; 
	exit();
}
else {
	
	echo "<div class='title'>Send a Top-up to this number</div>";
	
	//IF ERROR
	if ((ereg("error_code",$convert[2]) && $val!="0") || (ereg("error_code",$convert[7]))) {
		if ($convert[8]!="") {$error_code = $convert[8];}
		else {$error_code = $convert[3];}
		echo "<span class='label'>Number:</span><span class='value'>".$msisdn."</span><br />";
		echo "<span class='label'>Error:</span><span class='value'>".$error_code."</span><br />";
		echo "<span class='label'></span><span class='value'><a href='#' class='topup_try'>Please try Again</a></span><br />";
		exit();
	}
	
	echo "<span class='label'>Number: </span>";
	echo "<span class='valueshort'>";
	echo "<span id='change_msisdn' style='display:inline-block'>";
	echo $msisdn;
	echo "</span>";
	echo "</span>";
	echo "<span class='link'><a href='operators.php?cdn=1&dn=".$msisdn."' class='change_dn'>Edit Number</a></span><br />";
	
	echo "<span class='label'>Operator: </span>";
	echo "<span class='valueshort'>";
	echo "<span id='change_operator' style='display:inline-block'>";
	
	//CHANGE OPERATOR LOGIC
	if (isset($_GET["operatorid"])) {
		$results = mysql_query("select * from numbering_plan where operatorid = '".$_GET["operatorid"]."'") or die(mysql_error()); 
		$rows = mysql_fetch_array($results);
		$operatorname = $rows["operator"];
		$operatorid = $rows["operatorid"];
	}
	else {
		$operatorname = $val[1];
	}
	echo $operatorname;
	echo "</span>";
	echo "</span>";
	echo "<span class='link'><a href='operators.php?cid=".$cid."&dn=".$msisdn."' class='change_op'>Change Operator</a></span><br /><br />";
	
	if (isset($_GET["operatorid"])) {
		$inc_operid = "&operatorid=".$operatorid."";
	}
	//COMBINE PRODUCT/PRICE ARRAYS
	$c = array_combine($product_list, $retail_price_list);
	echo "<div class='title'>Select Top-up amount</div>";
	
	echo "<div style='width:780px;'>";
	foreach($c as $product=>$price) {
		echo "<div id='prodlist'><a href='topup.php?review=1&msisdn=".$msisdn."&product=".$product."&countryid=".$cid."&destcur=".$currency."&opname=".str_replace(" ","_",$operatorname)."&price=".$price."".$inc_operid."' class='review'><div class='prodlist'>";
		echo "<p><span class='amount'>".$product." ".$currency."</span><br />USD ".$price."</p>";
		echo "</div></a></div>";
	}
	echo "</div>";
}
?>

