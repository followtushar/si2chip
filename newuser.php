	<?php 
	include "db.php";

	include 'config.php';

	if(!isSet($_SESSION['email']))
	{
	header("Location: login.php");
	exit;
	}

	$email=$_SESSION['email'];
	function db_quote($value) {
		$connection = @mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		return "'" . mysqli_real_escape_string($connection,$value) . "'";
	}
	if(isset($_POST['fname'])){

	$fname= db_quote($_POST['fname']);
	$mname= db_quote($_POST['mname']);
	$lname= db_quote($_POST['lname']);
	$dob= db_quote($_POST['dob']);
	$department= db_quote($_POST['department']);
	$designation= db_quote($_POST['designation']);
	$doj= db_quote($_POST['doj']);
	$mstatus= db_quote($_POST['mstatus']);
	$gender= db_quote($_POST['gender']);
	$contact= db_quote($_POST['contact']);
	$alternate_contact= db_quote($_POST['alternate_contact']);

	$address= db_quote($_POST['address']);


	 if(isset($_FILES['image'])){
		  $errors= array();
		  $file_name = $_FILES['image']['name'];
		  $file_size = $_FILES['image']['size'];
		  $file_tmp = $_FILES['image']['tmp_name'];
		  $file_type = $_FILES['image']['type'];
		  $temp = explode(".", $_FILES["image"]["name"]);
		  $newfilename = round(microtime(true)) . '.' . end($temp);
		  $target_path = "images/user/" . $newfilename;
		  
		  $file_ext=strtolower(end($temp));
		  
		  $expensions= array("jpeg","jpg","png");
		  
		  if(in_array($file_ext,$expensions)=== false){
			 $errors[]="extension not allowed, please choose a JPEG or PNG file.";
		  }
		  
		  if($file_size > 2097152) {
			 $errors[]='File size must be excately 2 MB';
		  }
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp, $target_path);
			 $photo= $target_path;
		  }
		  
		  $sql = "UPDATE `emp_details` SET `fname` = $fname, `lname` = $lname, `gender` = $gender, `dob` = $dob, `mstatus` = $mstatus, `department` = $department, `designation` = $designation, `address` = $address, `joiningdate` = $doj, `contact` = $contact, `alternate_contact` = $alternate_contact, `photo` = '$photo' WHERE `emp_details`.`email` = '$email';";
		 
			if(mysqli_query($connection, $sql))
			{
				header("Location: dashboard.php");
			}
	   }

	 

	}

	?>



	<!DOCTYPE html>
	<html>
	<?php include "head.php"; ?>
	

	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script> 
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

	<script type="text/javascript">
	 function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#photo')
							.attr('src', e.target.result)
							.width(150)
							.height(200);
					};

					reader.readAsDataURL(input.files[0]);
				}
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
						
					 <?php  if(isSet($_SESSION['email'])){ ?>
					<li><a href="../employee/dashboard.php">Dashboard</a></li>
					<li><a href="../employee/logout.php">Log Out</a></li>
					<?php }  ?>
						
						
						
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
	<form action="#" id="recruitForm" name="recruitForm" method="post" enctype="multipart/form-data" >
			<div class="col-md-10 col-md-offset-1">
				<center><h2> New User</h2></center>
					
					
					<div class="row">
					<div class="form-group col-md-4">
						<label for="name">First Name<sup><font color="red">*</font></sup></label>
						<input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>" required >
					</div><div class="form-group col-md-4">
					
						<label for="name">Middle Name</label>
						<input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name" value="<?php if(isset($_POST['mname'])) echo $_POST['mname']; ?>"  >
					</div>
					
					<div class="form-group col-md-4">
						<label for="name">Last Name<sup><font color="red">*</font></sup></label>
						<input type="text" name="lname"  class="form-control" placeholder="Last Name" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>" required >
					</div>
					</div>
					<div class="form-group">
					<label for="dob">Date of Birth<sup><font color="red">*</font></sup></label>
					<input type="date" name="dob" id="dob" class="form-control">
					</div>
					
					
					<div class="form-group">
						<label for="name">Department<sup><font color="red">*</font></sup> </label>
						<input type="text" name="department" id="department" class="form-control" placeholder="Enter your name" value="<?php if(isset($_POST['department'])) echo $_POST['department']; ?>" required >
					</div>
					<div class="form-group">
						<label for="name">Designation <sup><font color="red">*</font></sup></label>
						<input type="text" name="designation" id="designation" class="form-control" placeholder="" value="<?php if(isset($_POST['designation'])) echo $_POST['designation']; ?>" required >
					</div>
					
					<div class="form-group">
					<label for="doj">Date of Joining<sup><font color="red">*</font></sup></label>
					<input type="date" name="doj" id="doj" class="form-control">
					</div>
					
					
					
					<div class="form-group">
						<label for="mstatus">Marital Status<sup><font color="red">*</font></sup></label>
						<select name="mstatus" id="mstatus" class="form-control" required>
							<option value="">--</option>	
							<option value="Single">Single</option>	
							<option value="Married">Married</option>	
							<option value="Divorced">Divorced</option>	
							<option value="Widowed">Widowed</option>	
						</select>
					</div>
					
					<div class="form-group">
						<label for="gender">Gender<sup><font color="red">*</font></sup></label>
						<select name="gender" id="gender" class="form-control" required>
								
							<option value="Male">Male</option>	
							<option value="Female">Female</option>	
						</select>
					</div>
				
					<div class="form-group">
						<label for="phnno">Contact No<sup><font color="red">*</font></sup></label>
						<div class="input-group">
							<span class="input-group-addon">+91</span>
							<input type="number" name="contact" id="contact" class="form-control" placeholder="Enter your contact no" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="phnno">Alternate Contact No</label>
						<div class="input-group">
							<span class="input-group-addon">+91</span>
							<input type="number" name="alternate_contact" id="alternate_contact" class="form-control" placeholder="Enter your contact no">
						</div>
					</div>
					
					<div class="form-group">
						<label for="address">Address<sup><font color="red">*</font></sup><br>
						</label>
						<textarea rows="5" cols="20" name="address" id="address" class="form-control"  required><?php if(isset($_POST['address'])) echo $_POST['address']; ?></textarea>
					</div>
					
					<?php  if(!empty($errors)) {
					echo "<div class=\"alert alert-danger\">".$errors."</div>";
					} ?>
					
				   <img id="photo" class="img-responsive" src="#" alt="your image" />
					<input type='file' onchange="readURL(this);" class="form-control" name="image" required/>
	 
			<br/>
			<br/>
					<input type="submit" name="submitbtn" id="submitbtn" class="btn btn-primary pull-right">
				</form><br/>
			<br/>
			<br/>
			<br/>
			</div>
			
			




