<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$usnm=$_SESSION['user'];

/*$res=mysql_query("SELECT * FROM users WHERE username='$usnm'");
$userRow=mysql_fetch_array($res);*/

if(isset($_POST['pgm-upd']))
{
	$opname = mysql_real_escape_string($_POST['oprogname']);
	$npname = mysql_real_escape_string($_POST['nprogname']);
	$descr = mysql_real_escape_string($_POST['progdesc']);
	
	
	$opname = trim($opname);
	$npname = trim($npname);
    if(!isset($descr))   
    {
	       $descr = trim($descr);
    }
    
	
	
	// Does program exist or not
	$query = "SELECT program_id FROM program WHERE program_name='$opname' AND program_user='$usnm'";
	$result = mysql_query($query) or die (mysql_error());
	
	$count = mysql_num_rows($result); // If program found, then update
	
	if($count == 1){

        $row = mysql_fetch_assoc($result);
        $pgmid = $row['program_id'];
		
		if(mysql_query("UPDATE program SET program_name = '$npname' WHERE program_id='$pgmid'"))
		{
			?>
			<script>alert('Successfully updated program details');</script>
			<?php
		}
		else
		{
			?>
			<script>alert('Cannot update program');</script>
			<?php
		}
        if(!isset($descr))	
        {
            if(mysql_query("UPDATE program SET program_description = '$descr' WHERE program_id='$pgmid'"))
            {
                ?>
                <script>alert('Successfully updated program details');</script>
                <?php
            }
            else
            {
                ?>
                <script>alert('Cannot update program');</script>
                <?php
            } 
        }  	
	}
	else{
			?>
			<script>alert('Sorry program doesnot exist);</script>
			<?php
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Programming++ - Update a program</title>
	
    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="pgp_php1.html">Programming++</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="pgp_php1.html"></a>
                    </li>
                    <li class="page-scroll">
                       <a href="">Hi <?php echo $usnm; ?>!</a>
                    </li>
                    <li class="page-scroll">
                        <a href="pgp_php1.html#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="snap.html">Editor</a>
                    </li>
                    <li class="page-scroll">
                        <a href="logout.php?logout">Log Out</a>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
<center>

<section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br><br>
                    <h2>Update Program Details</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">               
					<form method="post">
						<div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Program Name</label>
                                <input type="text" name="oprogname" class="form-control" placeholder="Old Program Name" id="oprogname" required data-validation-required-message="Please enter old program name">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Program Name</label>
                                <input type="text" name="nprogname" class="form-control" placeholder="New Program Name" id="nprogname" required data-validation-required-message="Please enter new program name">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Description</label>
                                <input type="text" name="progdesc" class="form-control" placeholder="Program Description" id="progdesc">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <!--<div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" placeholder="Your Password" id="password" required data-validation-required-message="Please enter a password">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Image Link</label>
                                <input type="text" class="form-control" placeholder="Image Link" id="imagelink" >
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>-->
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" name="pgm-upd" class="btn btn-success btn-lg">Submit</button>
                            </div>
                        </div>
                    </form>
                        <ul class="list-inline">
                            <li>
                                <a href="home.php">Program List</a>
                            </li>
                            <li>
                                <a href="progadd.php">Add A Program</a>
                            </li>
                            <li>
                                <a href="progdel.php">Delete A Program</a>
                            </li>
                        </ul>
                    <!--<form method="post" action="progsearch.php">
                    <input type="text" name="search" />
                    <input type="submit" name="submit" value="Search" >
                    </form>-->
                </div>
            </div>
        </div>
    </section>
    </center>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>About Us</h3>
                        <p>We're a bunch of geeks,<br> happy to help!</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://plus.google.com/" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/?lang=en" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="https://instagram.com/" class="btn-social btn-outline"><i class="fa fa-fw fa-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Contribute!</h3>
                        <p><a href="https://github.com/Keerthana17/programmingpp.git">Wanna help us out?</a><br>You're always welcome!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Programming++ 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
