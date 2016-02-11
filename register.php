<?php
include 'db.php';
$msg='';
if(!empty($_POST['email']) && isset($_POST['email']) &&  !empty($_POST['pwd1']) &&  isset($_POST['pwd1']) &&  !empty($_POST['pwd2']) &&  isset($_POST['pwd2'] ))
{
if($_POST['pwd1']==$_POST['pwd2'])
{
// username and password sent from Form
		$email=mysqli_real_escape_string($connection,$_POST['email']); 
		$password=mysqli_real_escape_string($connection,$_POST['pwd1']); 

		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';


		if(preg_match($regex, $email))
		{  
	
		

		function generateHashWithSalt() {
			$intermediateSalt = md5(uniqid(rand(), true));
			$salt = substr($intermediateSalt, 0, 6);
			return $salt;
		} 


		$salt=generateHashWithSalt();
		$password= hash("sha256", $password . $salt);
		$activation=hash('sha256',$email.time()); 	// Encrypted email+timestamp

		$count=mysqli_query($connection,"SELECT uid FROM users WHERE email='$email'");
if(mysqli_num_rows($count) < 1)
{
		mysqli_query($connection,"INSERT INTO users(email,salt,password,activation) VALUES('$email','$salt','$password','$activation');");
		mysqli_query($connection,"INSERT INTO emp_details(email) VALUES('$email');");
		//echo "INSERT INTO users(email,salt,password,activation) VALUES('$email','$salt','$password','$activation');";
		//Activation E-Mail Part 

		$to=$email;

		$subject="Email verification";
		require_once "mailer.php";

		$mail=mail($to,$subject,$message,$headers);
		$msg= "Registration successful, please activate email.";	

}
else
{
$msg= "The email is already taken, please try new.";	
}



}
else
{
   $msg = '<font color="#cc0000">The email you have entered is invalid, please try again.</font>';  
}


}
else {
	$msg='<font color="#cc0000">Password Not Matched.</font>';  
}
}
?>
<!DOCTYPE html>

<html>
<?php include "head.php"; ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <link href="./" rel="stylesheet">  
 <style type="text/css">

form {
 	background: rgba(226, 231, 233, 0.73);
    margin: auto;
    border-radius: 0.4em;
    border: 1px solid #A8B9C1;
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 5px 5px rgba(0,0,0,0.2);
}
.center {

align :center;
}
</style>
<script>
function recaptchaCallback() {
    $('#subbtn').removeAttr('disabled');
};
</script>


<body>

    <!--google analytics-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-48004790-1', 'si2chip.com');
        ga('send', 'pageview');

    </script>
    <!--google analytics ends here-->
    <!--header section-->
    <div class="container">
        <div class="row">
            <div class="col-md-3 silogo">
                <a href="#"><img src="../img/si2chipcompanylogo.png" class="thumbnail img-responsive"></a>
            </div>
            <div class="col-md-offset-6 sitopmenu">
                <ul class="nav nav-pills pull-right sitopcustommenu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="../career/career.html">Career</a></li>
                    <li><a href="../company/contactus.html">Contact us</a></li>
                    <li><a href="../employee/login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--header section ends here-->
    <!--side menu & center part-->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="well well-sm siwellsidemainmenu">
                    <a href="./company/aboutus.html" class="sisidemainmenu"><i class="fa fa-plus"></i> Company</a>

                </div>
                <div class="well well-sm siwellsidemainmenu">
                    <a href="./services/expertise.html" class="sisidemainmenu"><i class="fa fa-plus"></i> Expertise</a>
                </div>
                <div class="well well-sm siwellsidemainmenu">
                    <a href="./services/offerings.html" class="sisidemainmenu"><i class="fa fa-plus"></i> Services</a>
                </div>
                <div class="well well-sm siwellsidemainmenu">
                    <a href="./engmodel/engmodel.html" class="sisidemainmenu"><i class="fa fa-plus"></i> Engagement model</a>
                </div>
            </div>

<!--form part-->
<div class="col-md-9">
<form action="#" id="regform" name="regForm" method="post">
		<div class="col-md-10 col-md-offset-1">
			<center><h2 style="font-family:times new roman"> New User</h2></center>
				
			
			<?php if(!empty($msg)) { ?>
<div class="alert alert-danger">
							
                            
                        	<?php echo $msg; ?></div>
<?php } ?>
				
				
				<div class="form-group">
					<label for="email">E-Mail Id</label>
					<input type="email" name="email" id="email" class="form-control"  autocomplete="off" required >
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" class="form-control" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.pwd2.pattern = this.value;
"autocomplete="off" required>
				</div>
				<div class="form-group">
					<label for="password">Password </label>
					<input type="password"  class="form-control" title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
" required>
				</div>
				<div class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LdmaBcTAAAAAOMACGIQyo-vx__6Pgvvl564l6xW" required></div>
				


</fieldset>
<button type="submit" id="subbtn" class="btn btn-success pull-right" value="Save Changes" >Register</button>
</form>
<br/>
<br/>
<br/>
			
		</div>
	
		
	