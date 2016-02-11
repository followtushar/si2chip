<?php
include 'config.php';
require_once 'db.php';

// Check if the user is logged in

if(!isSet($_SESSION['email']))
{
header("Location: login.php");
exit;
}
$ses=$_SESSION['email'];
$query="SELECT * FROM `emp_details` WHERE `email`='$ses'" ;

if ($result = mysqli_query($connection, $query)) {

   
    while ($row = mysqli_fetch_assoc($result)) {
        
    
	
	
?>	
	<?php include "head.php"; ?>
	
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo $row['name']; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-144x144-precomposed.png">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

  <link rel="stylesheet" href="css/normalize.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
  <script src="js/vendor/jquery.hashchange.min.js"></script>
  <script src="js/vendor/jquery.easytabs.min.js"></script>

  <script src="js/main.js"></script>
  <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
      <![endif]-->
</head>
  <body class="bg-fixed bg-1">
<!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
   <div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-3 silogo">
                <a href="#"><img src="../img/si2chipcompanylogo.png" class="thumbnail img-responsive"></a>
            </div>
            <div class="col-md-offset-6 sitopmenu">
                <ul class="nav nav-pills pull-right sitopcustommenu">
                    <li><a href="index.php">Home</a></li>
                    
					 <?php  if(isSet($_SESSION['email'])){ ?>
					<li><a href="../employee/change.php">Change Password</a></li>
					<li><a href="../employee/logout.php">Log Out</a></li>
					<?php }  ?>
            </div>
        </div>
    </div>
    <div class="main wrapper clearfix">
      <!-- Header Start -->
        <header id="header">
            <div id="logo">
                <h2>
                    <?php echo $row['fname']; ?> <?php echo " ".$row['mname']." "; ?><?php echo $row['lname']; ?>
                </h2>
                <h4>
                   <?php echo $row['designation']; ?>
                </h4>
            </div>
        </header>
        <!-- Header End -->
        <!-- Main Tab Container -->
        <div id="tab-container" class="tab-container">
          <!-- Tab List -->
            <ul class='etabs'>
                <li class='tab' id="tab-about">
                  <a href="#about"><i class="icon-user"></i><span> About Me</span></a>
                </li>
                <li class='tab'>
                  <a href="#resume"><i class="icon-file-text"></i><span> Resume</span></a>
                </li>
        
                <li class='tab'>
                  <a href="#contact"><i class="icon-envelope"></i><span> Contact</span></a>
                </li>
            </ul>
          <!-- End Tab List -->
            <div id="tab-data-wrap">
              <!-- About Tab Data -->
                <div id="about">
                    <section class="clearfix">
                        <div class="g2">
                            <div class="photo">
                                <img src="./<?php echo $row['photo']; ?>" alt="<?php echo $row['fname']; ?>">
                            </div>
                            <div class="info">
                                <h2>
                                    <?php echo $row['fname']; ?> <?php echo " ".$row['mname']." "; ?><?php echo $row['lname']; ?>
                                </h2>
                                <h4>
                                    <?php echo $row['designation']; ?><br/>
									<?php echo $row['department']; ?>
                                </h4>
                                <p>
                                   
                                </p>
                            </div>
                        </div>
                        <div class="g1">
                            <div class="main-links sidebar">
                                <ul>
                                    <li>
                                        <a href="#resume">View My Resume</a>
                                    </li>
                                    
                                    <li>
                                        <a href="#contact">Hire me for your next project</a>
                                    </li>
                                    <li>
                                        <a href="#features">Features</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="break"></div>
                        <div class="contact-info">
                          <div class="g1">
                            <div class="item-box clearfix">
                              <i class="icon-envelope"></i>
                              <div class="item-data">
                                <h3><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></h3>
                                <p>Email Address</p>
                              </div>
                            </div>
                          </div>
                          <div class="g1">
                            <div class="item-box clearfix">
                              <i class="icon-facebook"></i>
                              <div class="item-data">
                                <h3><a href="http://fb.me/mistrymant">Tushar</a></h3>
                                <p>Facebook Profile</p>
                              </div>
                            </div>
                          </div>
                          <div class="g1">
                            <div class="item-box clearfix">
                              <i class="icon-twitter"></i>
                              <div class="item-data">
                                <h3><a href="http://twitter.com/followtuhar">@followtushar</a></h3>
                                <p>Twitter Handle</p>
                              </div>
                            </div>
                          </div>
                        </div>
                    </section><!-- content -->
                </div>
              <!-- End About Tab Data -->
              <!-- Resume Tab Data -->
                <div id="resume">
                    <section class="clearfix">
                        <div class="g2">
                            <h3>
                                Work Experience
                            </h3>
                            <ul class="no-list work">
                                <li>
                                    <h5>
                                        Freelance Web Designer
                                    </h5><span class="label label-info">2014-2016</span>
                                    <p>
                                        Worked on vaious projects .
                                    </p>
                                </li>
                               
                                
                            </ul>
                            <h3>
                                Education
                            </h3>
                            <ul class="no-list work">
                                <li>
                                    <h5>
                                      N.I.E.T Greater Noida
                                    </h5><span class="label label-success">2014-2018</span>
                                    <p>
                                        B.Tech
                                    </p>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="g1">
                            <div class="sidebar">
                                <h3>
                                    Skills
                                </h3>
                                <h5>
                                    Software
                                </h5>
                                <div class="meter emerald">
                                    <span style="width: 20.3%"><span>Photoshop</span></span>
                                </div>
                               
                                <div class="meter midnight">
                                    <span style="width: 50%"><span>Dreamweaver</span></span>
                                </div>
                                <div class="meter pomengrate">
                                    <span style="width: 80%"><span>Microsoft Office</span></span>
                                </div>
                                <div class="meter asbestos">
                                    <span style="width: 15%"><span>Linux</span></span>
                                </div>
                                <div class="break"></div>
                                <h5>
                                    Design
                                </h5>
                                <div class="meter emerald">
                                    <span style="width: 33.3%"><span>User Interface</span></span>
                                </div>
                                <div class="meter carrot">
                                    <span style="width: 05%"><span>Typography</span></span>
                                </div>
                                <div class="meter wisteria">
                                    <span style="width: 80%"><span>Web Applications</span></span>
                                </div>
                                <div class="break"></div>
                                <h5>
                                    Programming Language
                                </h5>
                                <div class="meter emerald">
                                    <span style="width: 80%"><span>HTML/CSS</span></span>
                                </div>
                                <div class="meter carrot">
                                    <span style="width: 85%"><span>PHP/MySql</span></span>
                                </div>
                                <div class="meter wisteria">
                                    <span style="width: 80%"><span>jQuery/JavaScript</span></span>
                                </div>
                                <div class="meter sunflower">
                                    <span style="width: 0%"><span>Ruby</span></span>
                                </div>
                                <div class="meter asbestos">
                                    <span style="width: 20%"><span>Python</span></span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
              <!-- End Resume Tab Data -->
              
              <!-- Contact Tab Data -->
                <div id="contact">
                    <section class="clearfix">
                       <div class="g1">
                         <div class="sny-icon-box">
                           <div class="sny-icon">
                              <i class="icon-globe"></i>
                            </div>
                            <div class="sny-icon-content">
                              <h4>My Address</h4>
                              <p><?php echo $row['address']; ?></p>
                            </div>
                         </div>
                       </div>
                       <div class="g1">
                         <div class="sny-icon-box">
                           <div class="sny-icon">
                              <i class="icon-phone"></i>
                            </div>
                            <div class="sny-icon-content">
                              <h4>Mobile Number</h4>
                              <p><?php echo $row['contact']; ?><br/><?php echo $row['alternate_contact']; ?></p>
                            </div>
                         </div>
                       </div>
                       <div class="g1">
                         <div class="sny-icon-box">
                           <div class="sny-icon">
                              <i class="icon-user"></i>
                            </div>
                            <div class="sny-icon-content">
                              <h4>About Me</h4>
                              <p>I love to work, so don't be shy, i am just an email away.</p>
                            </div>
                         </div>
                       </div>
                       <div class="break"></div>
                       
                    </section>
                </div>
              <!-- End Contact Data -->
            </div>
        </div>
        <!-- End Tab Container -->
        <footer>
            <p>
              Created By : Tushar Kumar  
            </p>
        </footer>
    </div><!-- #main -->
</div><!-- #main-container -->



</body>
</html>
<?php } } ?>
