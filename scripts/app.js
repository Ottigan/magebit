'use strict';

const mainButton = document.querySelector('#main-button'),
	movingPanel = document.querySelector('.transformer-container'),
	dimensionBorder = document.querySelector('.dimension-border'),
	signUpBtn = document.querySelector('.sign-up-span-btn'),
	loginBtn = document.querySelector('.login-span-btn'),
	formContainer = document.querySelector('.inner-form-container'),
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
	url = document.URL;

if (url.includes('signup=success')) {
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

signUpBtn.addEventListener('click', event => {
	dimensionBorder.style.cssText =
		'transform: translateX(-411px); transition: all linear 1s';
	movingPanel.style.cssText =
		'transform: translateX(-411px); transition: all linear 1s';
	formContainer.style.cssText = 'opacity: 0; transition: all linear 0.5s';
	setTimeout(() => {
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

loginBtn.addEventListener('click', event => {
	dimensionBorder.style.cssText =
		'transform: translateX(0px); transition: all linear 1s';
	movingPanel.style.cssText =
		'transform: translateX(0px); transition: all linear 1s';
	formContainer.style.cssText =
		'opacity: 0; transition: opacity linear 0.5s; margin-top: 65px';

	setTimeout(() => {
		form.action = 'auth_logic/login.php';
		nameInput.removeAttribute('required');
		nameContainer.style.cssText =
			'opacity: 0; display:none; transition: opacity linear 0.5s';
		mainButton.innerHTML = 'LOGIN';
		mainButton.name = 'login-btn';
		formContainer.style.cssText = 'opacity: 1; transition: opacity linear 0.5s';
	}, 500);
});

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
