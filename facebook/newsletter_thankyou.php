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
  <img src='http://www.ibsproject.org/assets/images/image_fundraising.jpg' width="540" />
  <div class="heading">IBS Newsletter Subscription</div>
  <p>Your email address is now registered. You will start receiving our newsletters shortly.</p>
  <div class="heading">Find out more about IBS</div>
  <!-- NAV: start -->
  <div id="nav">
    <div><a class="navitem" href="http://ibsproject.org/project.php" target="_blank">The Project</a></div>
    <div><a class="navitem" href="http://ibsproject.org/programmes.php" target="_blank">Programmes</a></div>
    <div><a class="navitem" href="http://ibsproject.org/fundraising.php" target="_blank">Support IBS</a></div>
    <div><a class="navitem" href="http://ibsproject.org/contact_us.php" target="_blank">Contact us</a></div>
  </div>
  <!-- NAV: stop -->
</div>
  <script type="text/javascript">Cufon.now();</script>
  <script>
$(".navitem").mouseenter(function(){
	$(this).text($(this).text()+'');
});

$(".navitem").mouseleave(function(){
	$(this).text($(this).text()+'');
});
</script>
<script type="text/javascript">Cufon.now();</script>
