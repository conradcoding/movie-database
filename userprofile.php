<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en" class="no-js">

<?php
	//head section
	include('sections/head.php');
	//header
	include('sections/header.php');
	//login form
	include('sections/login-form.php');
	//signup form
	include('sections/signup-form.php');
?>

<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="images/logo1.png" alt="" width="119" height="58">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1>Edward kennedy’s profile</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
						<a href="#" class="redbtn">Change avatar</a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li  class="active"><a href="userprofile.html">Profile</a></li>
							<li><a href="userfavoritelist.html">Favorite movies</a></li>
							<li><a href="userrate.html">Rated movies</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="#">Change password</a></li>
							<li><a href="#">Log out</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="form-style-1 user-pro" action="#">
					<form action="#" class="user">
						<h4>01. Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input type="text" placeholder="edwardkennedy">
							</div>
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input type="text" placeholder="edward@kennedy.com">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>First Name</label>
								<input type="text" placeholder="Edward ">
							</div>
							<div class="col-md-6 form-it">
								<label>Last Name</label>
								<input type="text" placeholder="Kennedy">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Country</label>
								<select>
								  <option value="united">United States</option>
								  <option value="saab">Others</option>
								</select>
							</div>
							<div class="col-md-6 form-it">
								<label>State</label>
								<select>
								  <option value="united">New York</option>
								  <option value="saab">Others</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="save">
							</div>
						</div>	
					</form>
					<form action="#" class="password">
						<h4>02. Change password</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Old Password</label>
								<input type="text" placeholder="**********">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input type="text" placeholder="***************">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input type="text" placeholder="*************** ">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="change">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- footer section-->
<?php
    include('sections/footer.php');
    ?>
<!-- end of footer section-->

<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>

<!-- userprofile14:04-->
</html>
