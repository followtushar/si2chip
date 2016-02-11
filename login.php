
<?php 
include("db.php");

session_start();



if(isSet($_SESSION['email']))
{
header("Location: dashboard.php");
exit;
}

$error='';
if(isset($_POST['ck']))
{
	$username=mysqli_real_escape_string($connection,$_POST['email']);
	$sql_salt="SELECT * FROM users WHERE email='$username'";
		$saltin = mysqli_query($connection,$sql_salt);
		$row = mysqli_fetch_assoc($saltin);
		$count=mysqli_num_rows($saltin);
		if($count==1)
		{
				$salt=$row['salt'];
				$activation= hash("sha256", $salt);
				$sql="UPDATE `users` SET `activation` = '$activation' WHERE email = '$username';";
				mysqli_query($connection,$sql);
				$to=$username;
				$subject="Password Recovery.";
				require_once "mailer.php";
				$mail=mail($to,$subject,$message2,$headers);
				$error="Check Your Mailbox for Password";
		}
		else{
			$error="Email Doesn't Exists";
		}
}

if(isset($_POST['log']))
 {
		// username and password received from loginform 
		$username=mysqli_real_escape_string($connection,$_POST['username']);
		$password=mysqli_real_escape_string($connection,$_POST['password']);

		
		//salt from db
		$sql_salt="SELECT * FROM users Inner JOIN emp_details ON users.email=emp_details.email WHERE users.email='$username'";
		$saltin = mysqli_query($connection,$sql_salt);
		$row = mysqli_fetch_assoc($saltin);
		$salt=$row['salt'];
		$status=$row['status'];
		$fname=$row['fname'];
		//new password
		$password= hash("sha256", $password . $salt); 
		
		//$password=hash('sha256',$password); // Encrypted password

		$sql_query="SELECT uid FROM users WHERE email='$username' and password='$password'";
		$result=mysqli_query($connection,$sql_query);
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count=mysqli_num_rows($result);

if($status==0){


$error="Please Verify Your Email";

}
// If result matched $username and $password, table row must be 1 row
else if($count==1)
{
			
			$_SESSION['email']=$username;
			if(!empty($fname))
			{
			header("location: dashboard.php");
			}
			else{
			header("location: newuser.php");
			}
}
else
{
			$error="Username or Password is invalid";
}
}
?>

<!DOCTYPE html>
<html>
<?php include "head.php"; ?>
 <link href="./css/style.css" rel="stylesheet">  
<script>

form {
 	   
	background: #E2E7E9;
    margin: auto;
    border-radius: 0.4em;
	
    border: 1px solid #A8B9C1;
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 5px 5px rgba(0,0,0,0.2);
}
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
<div class="col-md-7 col-md-offset-1">
<form method="post" action="#" >
<div class="col-md-10 col-md-offset-1">
  <h1>Employee Log in</h1>
  
										<?php if(!empty($error)) { 
											echo "<div class=\"alert alert-success\">";
											echo $error."</div>";
										 } ?>
										<?php if(isset($_GET['id'])) { 
												if($_GET['id']==1){
											echo "<div class=\"alert alert-success\">";
											echo "Account Activated!</div>";
											}
											else{
											echo "<div class=\"alert alert-success\">";
											echo "Account already Active!</div>";}}
											?>
  <div class="inset">
  <div class="form-group">
    <label for="email">EMAIL ADDRESS</label>
    <input type="email" name="username" id="email" required>
		<input type="hidden" name="log" id="log" class="form-control" value="1" required>
  </div>
   <div class="form-group">
    <label for="password">PASSWORD</label>
    <input type="password" name="password" id="password" required>
  </div>
  
  </div>
  <p class="p-container">
    <span><a href="register.php">New User? Register  </a></span>  
    <span><a href="#forgot" data-toggle="modal" data-target="#forgot"> Forgot Password? </a></span>  

    <input type="submit" name="go" id="go" value="Log in">
  </p>
</form>





<div class="modal fade" id="forgot" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content
      <div class="modal-content">-->
         <form action="#" id="recruitForm" name="recruitForm" method="post">
		<div class="col-md-10 col-md-offset-1">
<br/>
<br/>
<br/>
				<div class="form-group">
					<label for="email">E-Mail Id</label>
					<input type="email" name="email" id="email" class="form-control"  autocomplete="off" required >
				</div>
					<input type="hidden" name="ck" id="ck" class="form-control" value="1" required>
					
				</div>
       
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit</button>  
        
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></form>
     </div> </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="./js/vendor/bootstrap.min.js"></script>
  
</body>
</html>