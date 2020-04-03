<?php
session_start();
require_once "../../../resources/config/db.php";

// if test expired show test is over see 
if ((isset($_SESSION['loggedin']))&& $_SESSION['loggedin']=="tc-candidate") {
header("Location: test.php");
}
$message="none";
if(isset($_REQUEST['m']))
$message=$_REQUEST['m'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login | TechChef</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="alert.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-wrapper bg-gra-01 p-t-100 p-b-100 font-poppins">
            <div class="wrapper wrapper--w780">
                <div class="card card-3">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <h2 class="title">Login | Techchef</h2>
                        <div>
                           <form action="process-login.php" method="post">
						   <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Username" name="username" id="name">
							</div>
							
                            <!-- <div class="input-group">
                                <input class="input--style-3" type="email" placeholder="Email" name="email" id="email">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Phone" name="phone" id="phone"
                                    maxlength="10">
                            </div>

                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="College Name" name="college"
                                    id="college">
							</div> -->
							

							

                            <div class="input-group" id="last-group">
                                <input class="input--style-3" type="text" placeholder="Password" name="password"
                                    id="course">
                            </div>
                            <div id="button-div">
                                <!-- <p class="p-t-10" id="message">Here comes the text</p> -->
                                <button type="submit" class="btn btn--pill btn--green">Submit</button>

                            </div>
						   </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>























<!-- 

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | TechChef</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="alert.js"></script>
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-color: black;">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="process-login.php">
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
					Login | TechChef
					<span>Round-1</span>
					</span>
					

					<div class="wrap-input100 validate-input" data-validate="Enter username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100" data-placeholder=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder=""></span>
					</div>

	

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>


					</div>

					<div class="text-center p-t-90">
						<a class="txt1">
							Forgot Password? Contact us
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html> -->




<?php if($message=="expired") : ?>
       <script>
		   swal.fire("Test Expired","Test was expired at 11:59am on April 10, 2020","info");
	   </script>
    <?php endif; ?>

    <?php if($message=="early") : ?>
        <script>
		   swal.fire("Test not started","Test will start at 11:00am on April 9, 2020","info");
	   </script>
    <?php endif; ?>

    <?php if($message=="incorrect") : ?>
        <script>
		   swal.fire("Incorrect details","Please check your details or contact us","warning");
	   </script>
    <?php endif; ?>

    <?php if($message=="submitted") : ?>
        <script>
		   swal.fire("Test Submitted","Your test is already submitted","info");
	   </script>
    <?php endif; ?>
