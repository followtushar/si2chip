<?php
include 'db.php';
$msg='';
if(!empty($_GET['authKey']) && isset($_GET['authKey']))
{
	$code=mysqli_real_escape_string($connection,$_GET['authKey']);

	$c=mysqli_query($connection,"SELECT uid FROM users WHERE activation='$code'");

	if(mysqli_num_rows($c) > 0)
	{

	$count=mysqli_query($connection,"SELECT uid FROM users WHERE activation='$code' and status='0'");

	if(mysqli_num_rows($count) == 1)
	{
    mysqli_query($connection,"UPDATE users SET status='1' WHERE activation='$code'");
    $msg="Your account is activated";	
	header("Location: login.php?id=1");
      die("Redirecting to: login.php?id=1");
    }
    else
    {
	$msg ="Your account is already active, no need to activate again";
	header("Location: login.php?id=2");
      die("Redirecting to: login.php?id=2");
    
    }

    }
    else
    {
	$msg ="Wrong activation code.";
    }

}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Email Verification</title>



<link rel="stylesheet" href="<?php echo $base_url; ?>style.css"/>
</head>
<body>
	<div id="main">
	<h2><?php echo $msg; ?></h2>
	</div>
</body>
</html>
