<?php
include 'db.php';

session_start();


$msg='';
if(!empty($_GET['authKey']) && isset($_GET['authKey']))
{
	$code=mysqli_real_escape_string($connection,$_GET['authKey']);

	$c=mysqli_query($connection,"SELECT uid FROM users WHERE activation='$code'");
	
	if(mysqli_num_rows($c) > 0)
	{
	$row = mysqli_fetch_assoc($c);
	$id = $row['uid'];

    }
	else {
	echo "Wrong activation code.";
	exit;
    }

}
else if(!isSet($_SESSION['email'])){
exit;

}

if(isset($_POST['ck']))
{
	if($_POST['pwd1']==$_POST['pwd2']){
		
		$password=mysqli_real_escape_string($connection,$_POST['pwd1']);
		function generateHashWithSalt() {
			$intermediateSalt = md5(uniqid(rand(), true));
			$salt = substr($intermediateSalt, 0, 6);
			return $salt;
			}
		$salt=generateHashWithSalt();
		$password= hash("sha256", $password . $salt);
		
		if(isSet($_SESSION['email'])){
			$email=$_SESSION['email'];
			$sql=	"UPDATE `users` SET `password` = '$password', `salt` = '$salt' WHERE `email` = '$email';";
			}
		else{
			$sql=	"UPDATE `users` SET `password` = '$password', `salt` = '$salt' WHERE `uid` = '$id';";
		}
		$c=mysqli_query($connection,$sql);
		
	 
	if($c)
			{
				header("Location: login.php");
		}
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
                     <?php  if(isSet($_SESSION['email'])){ ?>
					<li><a href="../employee/dashboard.php">Dashboard</a></li>
					<li><a href="../employee/logout.php">Log Out</a></li>
					<?php } else { ?>
                    <li><a href="../employee/login.php">Login</a></li><?php } ?>
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
			<center><h2 style="font-family:times new roman"> Change Password</h2></center>
				
			
			<?php if(!empty($msg)) { ?>
<div class="alert alert-danger">
							
                            
                        	<?php echo $msg; ?></div>
<?php } ?>
	
	<div class="form-group">
					<label for="password">New Password</label>
					<input type="password" id="password" class="form-control" title="Password must contain at least 6 characters, including UPPER/lowercase and numbers" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd1" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
  if(this.checkValidity()) form.pwd2.pattern = this.value;
"autocomplete="off" required>
<input type="hidden" value="1" name="ck">
				</div>
				<div class="form-group">
					<label for="password"> Confirm Password </label>
					<input type="password"  class="form-control" title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" name="pwd2" onchange="
  this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
" required>
			
				


</fieldset>
<button type="submit" id="subbtn" class="btn btn-success pull-right">Change Password</button>
<br/>
<br/>
<br/>
</form>
