<script type="text/javascript" src="http://ibsproject.org/assets/jquery.js"></script>
<script type="text/javascript" src="http://ibsproject.org/assets/cufon-yui.js"></script>
<script type="text/javascript" src="http://ibsproject.org/assets/Helvetica_Neue_400.font.js"></script>
<script type="text/javascript" src="http://ibsproject.org/assets/Helvetica_Neue_500.font.js"></script>
<script>
Cufon.replace('#nav a', { hover: true });
Cufon.replace('.heading');
</script>
<style type='text/css'>
  #container, body, html {
	overflow: hidden;
	width: 520px;
	margin: 0; border:0; padding:0;
	color: #1F2126;
	font-family: Arial,Sans-Serif;
	font-size: 1em;
	line-height: 1.2;
  }
  .heading{
	margin: 20px 0 5px;
	padding: 0 0 5px 10px;
	border-bottom: 1px #979c99 solid;
	color: #346794;
	font-weight: bold;
	font-size: 1.1em;
  }
  p{
	font-size: 0.9em;
	margin: 5px 10px 10px;
  }
  .lineup {
	font-size: 0.9em;
	padding: 0px 10px;
  }
  #go_button {
	position: relative;
	top: 7px;
  	margin-top: -10px;
  }
  #error {
	display: none;
	margin-bottom: 20px;
	color: red;
	font-size: 0.8em;
  }
  #footer {
	font-size: 10px;
  }
  #emailAddress {
  	width: 210px;
  }
  #nav {
	height: 40px;
	min-height: 40px;
	margin-bottom: 20px;
	background-color: #09466a;
  }
  .navitem {
	float: left;
	width: 129px;
	height: 27px;
	padding-top: 13px;
	font-size: 12px;
	text-align: center;
	border-right: 1px #063b5b solid;
	text-decoration: none;
  }
  a.navitem {
	color: #FFFFFF;
  }
  a.navitem:hover {
	color: #09466a;
	background-color: #d9dbd0;
  }
</style>
<div id="container">
 <img src='http://www.ibsproject.org/assets/images/image_home.jpg' width="540" />
  <div class="heading">Creating the Opportunity, Realising the Potential</div>
  <p>IBS is a philanthropic project aimed at creating a world-class business school in Iran, which will educate and prepare Iranian men and women to become business leaders capable of transforming the country's economic landscape</p>
  <!-- VIDEO: start -->
  <script type="text/javascript" src="http://ibsproject.org/assets/flowplayer/flowplayer-3.1.4.min.js"></script>
  <a href="http://ibsproject.org/assets/videos/IBS_promo_video.flv" style="display:block;width1:430px;height1:275px;width:530px;height:339px" id="flplayer"></a>
  <script>
	flowplayer("flplayer", "http://ibsproject.org/assets/flowplayer/flowplayer.swf", { clip: {autoPlay: false, autoBuffering: false}, plugins: {controls:{url: 'http://ibsproject.org/assets/flowplayer/flowplayer.controls.swf'}}});
  </script>
  <!-- VIDEO: end -->
  <!-- NAV: start -->
  <div class="heading">Find out more about IBS</div>
  <div id="nav">
	<div><a class="navitem" href="http://ibsproject.org/project.php" target="_blank">The Project</a></div>
	<div><a class="navitem" href="http://ibsproject.org/programmes.php" target="_blank">Programmes</a></div>
	<div><a class="navitem" href="http://ibsproject.org/fundraising.php" target="_blank">Support IBS</a></div>
	<div><a class="navitem" href="http://ibsproject.org/contact_us.php" target="_blank">Contact us</a></div>
  </div>
  <!-- NAV: stop -->
  <!--   <div class="heading">Subscribe to IBS Newsletter</div> -->
  <form id="newsletter_form" action="http://ibsproject.org/controllers/newsletter.php" method="POST">
	<p>Subscribe to IBS Newsletter:&nbsp;
	  <input type="text" name="emailAddress" id="emailAddress" value="Enter email address" />
	  <input type="hidden" value="fromFacebook" name="fromFacebook" />&nbsp;
	  <a href="#" id="newsletter_submit" class="button"><img id="go_button" src="http://ibsproject.org/assets/images/go.gif" alt="GO" /></a>
	</p>
  </form>
  <div id="error" class="lineup"></div>
  <br />
  <iframe src="http://www.facebook.com/plugins/like.php?href=http://www.facebook.com/pages/IBS-Project/176240462425266?sk=app_190322544333196&layout=box_count&show_faces=false&width=450&action=like&font=tahoma&colorscheme=light&height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:65px;" allowTransparency="true"></iframe>
  <!--   <div id="footer">Copyright &copy; 2011 Iranian Business School Project</div> -->
</div>
<script>
$(".navitem").mouseenter(function(){
	$(this).text($(this).text()+'');
});

$(".navitem").mouseleave(function(){
	$(this).text($(this).text()+'');
});

$("#emailAddress").click(function(){
  this.focus();
  this.select();
  $("#error").hide();
});

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
	$('#newsletter_form').submit();

  } else {

	$("#error").show();

  }

  return false;
});
</script>
<script type="text/javascript">Cufon.now();</script>
