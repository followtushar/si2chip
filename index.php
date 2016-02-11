<!DOCTYPE html>
<html>
<?php include "head.php"; 
session_start();
?>



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
            <div class="col-md-offset-4">
                <img src="../img/si2biglogo.png" class="thumbnail img-responsive sibiglogo">
            </div>
        </div>
        <!--body content-->
        <div class="col-md-offset-4">
            <div class="siwellhome">
                <h3 class="sicontent">Everyone has been talking about quality design services</h3>
                <h2 class="sicontent siredcontent">We decided to walk the talk</h2>
                <a class="btn btn-danger" href="../services/walk_the_talk.html">Read more <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
        <!--body content ends here-->
    </div>
    <!--side menu & center parts ends here-->
    <!--footer section-->
   <?php include "foot.php"; ?>