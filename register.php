<?php
	// Start Session
	session_start();

	// Database Connection
	include "includes/dbh.inc.php";

	//If user is already logged in, redirect to home page
    if(isset($_SESSION['login'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register | Ideas</title>
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		<!-- Material Icons -->
		<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
		<!-- Bootstrap core CSS -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
		<!-- JQuery -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap tooltips -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<!-- Local Stylesheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<!-- Local Script -->
		<script type="text/javascript" src="js/script.js"></script>
	</head>

    <body>

        <!-- Registration Form -->

		<div class="container">
            <div class="row justify-content-center">
                <div class="form col-lg-8 mt-5 px-0 shadow">
                    <div class="card-header text-center text-light p-3" id="form-header">Register</div>
		        	<form class="bg-white p-4" action="includes/register.inc.php" method="post">
		          		<div class="form-row">
		            		<div class="form-group col-md-6">
								<label>First Name</label>
								<?php if (isset($_GET['fname'])):?>
								<input type="text" class="form-control" name="fname" value="<?php echo ($_GET['fname']); ?>" required>
								<?php else :?>
								<input type="text" class="form-control" name="fname" required>
								<?php endif ?>
							</div>
							<div class="form-group col-md-6">
								<label>Last Name</label>
								<?php if (isset($_GET['lname'])):?>
								<input type="text" class="form-control" name="lname" value="<?php echo ($_GET['lname']); ?>" required>
								<?php else :?>
								<input type="text" class="form-control" name="lname" required>
								<?php endif ?>
							</div>
		          		</div>
		            	<div class="form-group">
							<label>Email Address</label>
							<?php if (isset($_GET['mail'])):?>
							<input type="email" class="form-control" name="mail" value="<?php echo ($_GET['mail']); ?>" required>
							<?php else :?>
							<input type="email" class="form-control" name="mail" required>
							<?php endif ?>
						</div>
		          		<div class="form-row">
				            <div class="form-group col-md-6">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pwd" required>
				            </div>
				            <div class="form-group col-md-6">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="pwd-repeat" required>
				            </div>
                        </div>
                        <div class="form-row">
				            <div class="form-group col-md-6">
				                <label>Department</label>
								<select id="inputDepartment" class="form-control" name="dprtmnt[]" required>
									<option disabled selected value>Choose...</option>
									<?php
									// Select all departments from the department table and list them in the dropdown-list      
									$results = mysqli_query($conn, "SELECT * FROM department");
									while ($row = mysqli_fetch_array($results)) { ?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
									<?php } ?>
								</select>
				            </div>
				            <div class="form-group col-md-6">
				                <label>Gender</label>
				                <select id="inputGender" class="form-control" name="gndr[]" required>
				                    <option disabled selected value>Choose...</option>
                                    <option value='male'>Male</option>
                                    <option value='female'>Female</option>
                                    <option value='other'>Other</option>
				                </select>
				            </div>
		          		</div>
						<button type="submit" class="btn btn-primary" name="register-submit">Register</button>
						<p>Already have an account?
                            <a href="login.php">Login</a>
                        </p>
						<?php
							// Error messages
							if (isset($_GET['error'])) {
								if ($_GET['error'] == "emptydprtmnt") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please select a department
									</p></div>';
								}
								else if ($_GET['error'] == "emptygndr") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please select a gender
									</p></div>';
								}
								else if ($_GET['error'] == "emptyfields") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please fill in all the fields
									</p></div>';
								}
								else if ($_GET['error'] == "invalidmail") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please enter a valid email address
									</p></div>';
								}
								else if ($_GET['error'] == "invalidfname") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please enter a valid first name, letters only
									</p></div>';
								}
								else if ($_GET['error'] == "invalidlname") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Please enter a valid last name, letters only
									</p></div>';
								}
								else if ($_GET['error'] == "passwordcheck") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									Passwords do not match
									</p></div>';
								}
								else if ($_GET['error'] == "emailtaken") {
									echo '<div class="text-center">
									<p class="text-white" style="background-color: #bb2124; padding: 10px 0 10px 0;">
									This email address is already taken
									</p></div>';
								}
							}
						?>
		        	</form>
                </div>
            </div>
		</div>

        <!-- /.Registration Form -->

    </body>
    
</html>
