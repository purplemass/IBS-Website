// **********************************************
// Cufon fonts
// **********************************************

//Cufon.replace('#nav .text a span', { hover: true , hoverables: { a: false, div: false, span: true } } );
Cufon.replace('#nav a', { hover: true });
Cufon.replace('#menuleft a', { hover: true });
Cufon.replace('#menuright a', { hover: true });
Cufon.replace('#menuright p');
Cufon.replace('#menuright .quicklinks');
Cufon.replace('#menuleft #announcement p');
Cufon.replace('#menuleft #announcement .white');
Cufon.replace('#title .text');
Cufon.replace('#body .intitle');
Cufon.replace('#footer .text');
Cufon.replace('#loggedin');
/* Cufon.replace('.buttons'); */
Cufon.replace('.caption');

// **********************************************
//
// **********************************************

$(document).ready(function(){

	// add target to external & PFD linkes
	$('a[href^="http://"]')
		.attr("target", "_blank");
	$('a[href$=".pdf"]')
		.attr("target", "_blank");
	
	// donation pages
	$("#main_form #email").focus();
	$("#main_form #forename").focus();
	$("#main_form #amount").focus();

	// db_result
	//$('#db_result td').attr('width', '140');



	/* 	DONATION BUTTONS */

	// donate start button
	$("#donate_start, #donate_start2, #donate_start3").click(function(){
		$('#page_flag').val('donate');
		$('#sys_flag').val('donate');
		$('#main_form').submit();
		return true;
	});

	// click Donate button
	$("#donate_button").click(function(){
		if ($("#amount").val() == '')
		{
			$('#error_div').text('You must enter an amount below');
			$('#error_div').addClass('error_message');
			$("#subscribe #amount").focus();
			return false;
		} else if (isNaN( $('#amount').val() )) {
			$('#error_div').text('Please enter numbers only');
			$('#error_div').addClass('error_message');
			$("#subscribe #amount").focus();
			return false;
		} else if ( $('#taxpayer_yes').attr('checked') == false && $('#taxpayer_no').attr('checked') == false) {
			$('#error_div').text('Please select whether you are a UK taxpayer');
			$('#error_div').addClass('error_message');
			return false;
		} else {
			//$(this).attr('disabled', 'true');
			$('#main_form').attr('action', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
			$('#main_form').submit();
			return true;
		}
	});

	// registration form radio buttons select
	$("#taxpayer_yes_select").click(function(){
		$('#taxpayer_yes').attr("checked", "checked");
		$('#custom').val('TAXPAYER_YES');
		return true;
	});

	$("#taxpayer_no_select").click(function(){
		$('#taxpayer_no').attr("checked", "checked");
		$('#custom').val('TAXPAYER_NO');
		return true;
	});

	/* 	LOGOUT BUTTONS */

	$("#logout, #logout_right").click(function(){
		$.post('register.php',{
			'page_flag': 'logout',
			'sys_flag': $('#sys_flag').val()
		}, function(sys_flag){
			// sys_flag will be sent back from PHP script register.php
			// 	go to same page if this is register
			// 	otherwise we're should go to fundraising.php
			if (sys_flag == 'donate')
				$(location).attr('href', 'fundraising.php?logout');
			else
				$(location).attr('href', '?logout');
		});
		return true;
	});

	/* 	REGISTRATION BUTTONS */

	// register start button
	$("#register_start").click(function(){
		$('#page_flag').val('');
		$('#sys_flag').val('register');
		$('#main_form').submit();
		return true;
	});

	// registration form submit button
	$("#submit").click(function(){
		$('#main_form').submit();
		return true;
	});

	// registration form submit button
	$("#cancel").click(function(){
		history.go(-1);
		return false;
	});

	// edit button
	$("#edit_button, #edit_button_inline").click(function(){
		$('#page_flag').val('edit');
		$('#main_form').submit();
		return true;
	});

	// registration form password forgotten button
	$("#password_reminder, #password_reminder_menu").click(function(){
		$('#page_flag').val('password_reminder');
		$('#main_form').submit();
		return true;
	});

	// registration form radio buttons select
	$("#radio_yes_select").click(function(){
		$('#radio_yes').attr("checked", "checked");
		$('#submit').text("Log in");
		return true;
	});

	// registration form radio buttons select
	$("#password").click(function(){
		$("#radio_yes_select").click();
		return true;
	});

	$("#radio_no_select").click(function(){
		$('#radio_no').attr("checked", "checked");
		$('#submit').text("Create Acount");
		return true;
	});

	/* 	NEWSLETTER */

	// archived_newsletters_button
	$(".archived_newsletters_button").click(function(){
		if ($('#archived_newsletters').css('display') == 'none')
			$('#archived_newsletters').css('display', 'block')
		else
			$('#archived_newsletters').css('display', 'none')
		$(".archived_newsletters_button").blur();
		return false;
	});

	// select the input box when clicked
	$("#emailAddress").click(function(){
		this.focus();
		this.select();
		$("#error").hide();
		$("#success").hide();
	});
	
	// validate email & send
	$("#newsletter_submit").click(function(){

		$("#error").hide();
		
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		var emailAddressVal = $("#emailAddress").val();
		
		if(emailAddressVal == '') {
		
			$("#error").html('You forgot to enter your email address.');
			hasError = true;
		
		} else if(!emailReg.test(emailAddressVal)) {
		
			$("#error").html('Please enter a valid email address.');
			hasError = true;
		
		}
		
		if (hasError == false) {
			
			$(this).hide();
			
			

			$.ajax({
				type:		"POST",
				url:		"controllers/newsletter.php",
				data:		"emailAddress=" + emailAddressVal,
				success:	function(output) {
								//alert(output);
								if (output == 'OK') {
									$("#newsletter_form").hide();
						   			$("#success").show();
						   			$("#error").hide();
						   		} else {
						   			errorResponse(output)
						   		}
				},
				error:		errorResponse
             });  

				$("#error").html('Processing. Please wait.');
				$("#error").show();

		} else {

			$("#newsletter_form").show();		
			$("#error").show();
		
		}
		
		return false;
		
	});
});

// **********************************************
// errorResponse
// **********************************************
function errorResponse(output) {
	//alert(output);
	$("#newsletter_form").show();
	$("#error").html('There was an error - please try again later.');
	$("#error").show();
	$("#newsletter_submit").show();

}

// **********************************************
// change image (test_image.php only)
// **********************************************
function CI(img)
{
	$("#main_image").attr("src", "test_images/" + img + ".jpg");

}

// **********************************************
// 
// **********************************************
			
/*			
			//$("#sendEmail li.buttons").append('<img src="/images/template/loading.gif" alt="Loading" id="loading" />');
			
			$.post("_sendemail.php",{ emailAddress: emailAddressVal, success: showResponse, error: showError },
		   		function(data){
		   			$("#newsletter_form").hide();
		   			$("#success").show();
					//$("#sendEmail").slideUp("normal", function(){
					//	$("#success").show();
						//$("#sendEmail").before('<h1>Success</h1><p>Your email was sent.</p>');
					//});
				}
			);
*/			

