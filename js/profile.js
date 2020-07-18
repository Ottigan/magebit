'use strict';

const attributeTable = document.querySelector('table');

// Changing TD elements from plain text to contain INPUT elements
let editAttribute = function (event) {
	let target = event.target;

	if (target.classList.contains('edit') && event.type === 'click') {
		let targetID = target.id,
			targetAttribute = document.getElementById(`attribute-${targetID}`),
			targetAttribValue = document.getElementById(`attribValue-${targetID}`);

		targetAttribute.innerHTML = `<input class="updateAttribute-${targetID}" name="attribute" maxlength="18" value="${targetAttribute.innerHTML}" />`;
		targetAttribute.style.paddingLeft = '0px';
		targetAttribValue.innerHTML = `<textarea class="updateAttribValue-${targetID}" name="attribValue">${targetAttribValue.innerHTML}</textarea>`;
		targetAttribValue.style.paddingLeft = '0px';
		target.innerHTML = 'Save';
		target.classList.toggle('edit');
		target.classList.toggle('save');
		document.querySelector(`.updateAttribute-${targetID}`).focus();

		// Appending new values to HREF for SAVE anchor
		// Anchor will provide information to PHP script to update DB
	} else if (target.classList.contains('save')) {
		let targetID = target.id,
			attributeInput = document.querySelector(`.updateAttribute-${targetID}`),
			attribValueInput = document.querySelector(
				`.updateAttribValue-${targetID}`
			);

		target.href = `profile.php?edit=${targetID}&attribute=${attributeInput.value}&attribValue=${attribValueInput.value}`;
	}
};

attributeTable.addEventListener('click', editAttribute);
attributeTable.addEventListener('mousedown', editAttribute);
