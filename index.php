<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Magebit</title>
	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="styles/style.css" />
</head>

<body>
	<main>
		<div class="container">
			<div class="sign-up-block">
				<h2>Don’t have an account?</h2>
				<span class="under-line"></span>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
					eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p>
				<span class="sign-up-span-btn button">
					<h4>SIGN UP</h4>
				</span>
			</div>
			<div class="login-container">
				<div class="login-block">
					<h2>Have an account?</h2>
					<span class="under-line"></span>
					<p>
						Lorem ipsum dolor sit amet consectetur adipisicing elit.
					</p>
					<span class="login-span-btn button">
						<h4>LOGIN</h4>
					</span>
				</div>
			</div>
			<div class="dimension-border">
				<div class="top-triangle triangle"></div>
				<div class="solid-border"></div>
				<div class="bottom-triangle triangle"></div>
			</div>
		</div>

		<div class="transformer-container">
			<div class="form-container">
				<div class="inner-form-container">
					<header>
						<div>
							<h2 class="transformer-h2">Login</h2>
							<img src="assets/logo.png" alt="Logo of Magebit - Stylized warping letter M " />
						</div>
						<span class="under-line"></span>
					</header>
					<?php
					if (isset($_GET['error'])) {
						if ($_GET['error'] == 'emptyfields') {
							echo  '<p class="error-msg">Empty fields not allowed</p>';
						} else if ($_GET['error'] == 'sqlerror') {
							echo  '<p class="error-msg">Oops! Something went wrong</p>';
						} else if ($_GET['error'] == 'wrongpwd') {
							echo  '<p class="error-msg">Incorrect password!</p>';
						} else if ($_GET['error'] == 'noaccount') {
							echo  '<p class="error-msg">Oops! Account does not exist!</p>';
						} else if ($_GET['error'] == 'invalidnameemail') {
							echo  '<p class="error-msg">Invalid name and email format!</p>';
						} else if ($_GET['error'] == 'invalidemail') {
							echo  '<p class="error-msg">Invalid email format!</p>';
						} else if ($_GET['error'] == 'invalidname') {
							echo  '<p class="error-msg">Invalid name format!</p>';
						} else if ($_GET['error'] == 'emailtaken') {
							echo  '<p class="error-msg">Invalid name format!</p>';
						}
					} else if (isset($_GET['signup']) && $_GET['signup'] == 'success') {
						echo  '<p class="success-msg">Success!</p>';
					}
					?>
					<form class="transformer-from" action="auth_logic/login.php" method="POST">
						<div class="name-input-container">
							<div class="input-container">
								<label class="name-label" for="name">Name<span>*</span></label>
								<img id="name-icon" src="assets/user_inactive.png" alt="Icon of a person" />
							</div>
							<input id="name" type="text" name="name" pattern="[A-Za-z ]+" autocomplete="off" />
						</div>
						<div class="email-input-container">
							<div class="input-container">
								<label class="email-label" for="email">Email<span>*</span></label>
								<img id="email-icon" src="assets/mail_inactive.png" alt="Icon of an envelope" />
							</div>
							<input id="email" type="email" name="email" autocomplete="email" required />
						</div>
						<div class="password-input-container">
							<div class="input-container">
								<label class="password-label" for="password">Password<span>*</span></label>
								<img id="password-icon" src="assets/lock_inactive.png" alt="Icon of a lock" />
							</div>
							<input id="password" type="password" name="pwd" autocomplete="current-password" required />
						</div>
						<div class="main-button-container">
							<button id="main-button" class="button" type="submit" name="login-btn">
								LOGIN
							</button>
							<p>Forgot?</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</main>
	<footer>
		<h5>ALL RIGHTS RESERVED "MAGEBIT" 2016.</h5>
	</footer>
	<script src="js/app.js"></script>
</body>

</html>