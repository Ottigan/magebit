'use strict';

const mainButton = document.querySelector('#main-button'),
	movingPanel = document.querySelector('.transformer-container'),
	dimensionBorder = document.querySelector('.dimension-border'),
	signUpBtn = document.querySelector('.sign-up-span-btn'),
	loginBtn = document.querySelector('.login-span-btn'),
	formContainer = document.querySelector('.inner-form-container'),
	transformerH2 = document.querySelector('.transformer-h2'),
	form = document.querySelector('.transformer-from'),
	nameContainer = document.querySelector('.name-input-container'),
	nameLabel = document.querySelector('.name-label'),
	nameIcon = document.getElementById('name-icon'),
	nameInput = document.getElementById('name'),
	emailLabel = document.querySelector('.email-label'),
	emailIcon = document.getElementById('email-icon'),
	emailInput = document.getElementById('email'),
	passwordLabel = document.querySelector('.password-label'),
	passwordIcon = document.getElementById('password-icon'),
	passwordInput = document.getElementById('password'),
	url = document.URL;

// Applying values to input elements
// that were passed by our PHP in case of errors
// and adjusting UI to reduce amount of unneeded clicks
// it is done to improve UX

if (url.includes('signup=success') || url.includes('noaccount')) {
	emailInput.focus();
} else if (url.includes('wrongpwd')) {
	passwordInput.focus();
} else if (url.includes('index.php?')) {
	dimensionBorder.style.cssText = 'transform: translateX(-411px);';
	movingPanel.style.cssText = 'transform: translateX(-411px);';
	form.action = 'auth_logic/signup.php';
	nameContainer.style.cssText = 'display:block;';
	if (url.includes('name=')) {
		nameInput.value = url.substring(
			url.indexOf('name=') + 5,
			url.indexOf('&email')
		);
	}

	if (url.includes('email=')) {
		emailInput.value = url.substring(url.indexOf('email=') + 6, url.length);
	}

	mainButton.innerHTML = 'SIGN UP';
	mainButton.name = 'sign-up-btn';
	formContainer.style.cssText = 'margin-top: 65px';
}

// Transforming all the parameters for the moving panel
// so that it is possible to Sign Up

signUpBtn.addEventListener('click', event => {
	dimensionBorder.style.cssText =
		'transform: translateX(-411px); transition: all linear 1s';
	movingPanel.style.cssText =
		'transform: translateX(-411px); transition: all linear 1s';
	formContainer.style.cssText = 'opacity: 0; transition: all linear 0.5s';
	setTimeout(() => {
		transformerH2.innerHTML = 'Sign Up';
		form.action = 'auth_logic/signup.php';
		nameInput.setAttribute('required', 'true');
		nameContainer.style.cssText =
			'opacity: 1; display:block; transition: all linear 0.5s';
		mainButton.innerHTML = 'SIGN UP';
		mainButton.name = 'sign-up-btn';
		formContainer.style.cssText =
			'opacity: 1; transition: opacity linear 0.5s; margin-top: 65px';
	}, 500);
});

// Transforming all the parameters to initial state
// so that it is possible to Login

loginBtn.addEventListener('click', event => {
	dimensionBorder.style.cssText =
		'transform: translateX(0px); transition: all linear 1s';
	movingPanel.style.cssText =
		'transform: translateX(0px); transition: all linear 1s';
	formContainer.style.cssText =
		'opacity: 0; transition: opacity linear 0.5s; margin-top: 65px';

	setTimeout(() => {
		transformerH2.innerHTML = 'Login';
		form.action = 'auth_logic/login.php';
		nameInput.removeAttribute('required');
		nameContainer.style.cssText =
			'opacity: 0; display:none; transition: opacity linear 0.5s';
		mainButton.innerHTML = 'LOGIN';
		mainButton.name = 'login-btn';
		formContainer.style.cssText = 'opacity: 1; transition: opacity linear 0.5s';
	}, 500);
});

// Changing the appearance of the current input element that is being FOCUSED

formContainer.addEventListener('focusin', event => {
	if (event.target.id === 'name') {
		nameIcon.src = 'assets/user_active.png';
		nameLabel.style.cssText = 'font-size: 10px';
		nameLabel.innerHTML = 'NAME<span>*</span>';
	} else if (event.target.id === 'email') {
		emailIcon.src = 'assets/mail_active.png';
		emailLabel.style.cssText = 'font-size: 11px';
		emailLabel.innerHTML = 'EMAIL<span>*</span>';
	} else if (event.target.id === 'password') {
		passwordIcon.src = 'assets/lock_active.png';
		passwordLabel.style.cssText = 'font-size: 11px';
		passwordLabel.innerHTML = 'PASSWORD<span>*</span>';
	}
});

// Reverting changes that were applied to the FOCUSED
// input element

formContainer.addEventListener('focusout', event => {
	if (event.target.id === 'name') {
		nameIcon.src = 'assets/user_inactive.png';
		nameLabel.style.cssText = '';
		nameLabel.innerHTML = 'Name<span>*</span>';
	} else if (event.target.id === 'email') {
		emailIcon.src = 'assets/mail_inactive.png';
		emailLabel.style.cssText = '';
		emailLabel.innerHTML = 'Email<span>*</span>';
	} else if (event.target.id === 'password') {
		passwordIcon.src = 'assets/lock_inactive.png';
		passwordLabel.style.cssText = '';
		passwordLabel.innerHTML = 'Password<span>*</span>';
	}
});
