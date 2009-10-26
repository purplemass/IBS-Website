// **********************************************
// Cufon fonts
// **********************************************

//Cufon.replace('#nav .text a span', { hover: true , hoverables: { a: false, div: false, span: true } } );
Cufon.replace('#nav a', { hover: true });
Cufon.replace('#menuleft a', { hover: true });
Cufon.replace('#menuright a', { hover: true });
Cufon.replace('#menuright .quicklinks');
Cufon.replace('#title .text');
Cufon.replace('#body .intitle');
Cufon.replace('#footer .text');

// **********************************************
//
// **********************************************

$(document).ready(function(){

	// add target to external & PFD linkes
	$('a[href^="http://"]')
		.attr("target", "_blank");
	$('a[href$=".pdf"]')
		.attr("target", "_blank");
	
	// select the input box when clicked
	$("#emailAddress").click(function(){
		this.focus();
		this.select();
		$("#error").hide();
		$("#success").hide();
	});

	// donation pages
	$("#email").focus();
	$("#forename").focus();
	$("#amount").focus();	

	// validate email & send
	$("#submit").click(function(){

		$("#error").hide();
		
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

		var emailAddressVal = $("#emailAddress").val();
		
		if(emailAddressVal == '') {
		
			$("#error").html('You forgot to enter the email address.');
			hasError = true;
		
		} else if(!emailReg.test(emailAddressVal)) {
		
			$("#error").html('Please enter a valid email address.');
			hasError = true;
		
		}
		
		if(hasError == false) {
			
			$(this).hide();

			$.ajax({
				type:		"POST",
				url:		"_sendemail.php",
				data:		"emailAddress=" + emailAddressVal,
				success:	function(output) {
								//alert(output);
								if (output == 'OK') {
									$("#subscriptionform").hide();
						   			$("#success").show();
						   			$("#error").hide();
						   		} else {
						   			errorResponse()
						   		}
				},
				error:		errorResponse
             });  

		} else {

			$("#subscriptionform").show();		
			$("#error").show();
		
		}
		
		return false;
		
	});
});

// **********************************************
// errorResponse
// **********************************************
function errorResponse() {

	$("#subscriptionform").show();
	$("#error").html('There was an error - please try again later.');		
	$("#error").show();
	$("#submit").show();

}

// **********************************************
// 
// **********************************************
			
/*			
			//$("#sendEmail li.buttons").append('<img src="/images/template/loading.gif" alt="Loading" id="loading" />');
			
			$.post("_sendemail.php",{ emailAddress: emailAddressVal, success: showResponse, error: showError },
		   		function(data){
		   			$("#subscriptionform").hide();
		   			$("#success").show();
					//$("#sendEmail").slideUp("normal", function(){
					//	$("#success").show();
						//$("#sendEmail").before('<h1>Success</h1><p>Your email was sent.</p>');
					//});
				}
			);
*/			

