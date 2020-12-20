document.querySelector('.img__btn').addEventListener('click', function() {
	document.querySelector('.__back').classList.toggle('moved-left');
	document.querySelector('.cont').classList.toggle('s--signup');
	if (document.querySelector('.cont').classList.contains('s--signup')) {
		document.title = "Phonebook | Signup";
	}
	else {
		document.title = "Phonebook | Signin";
	}
});
var view = document.getElementById('view');
view.addEventListener('click', function (e) {
	if (view.classList.contains('active')) {
		this.parentElement.querySelector('input').setAttribute('type', 'password');
	}
	else {
		this.parentElement.querySelector('input').setAttribute('type', 'text');
	}
	document.getElementById('view').classList.toggle('active');
});
function addEventListen(el, eventName, handler) {
	if (el.addEventListener) {
	  	el.addEventListener(eventName, handler);
	} else {
	  	el.attachEvent('on' + eventName, function(){
			andler.call(el);
	  	});
	}
}
function addEventListeners(selector, type, handler) {
	var elements = document.querySelectorAll(selector);
	for (var i = 0; i < elements.length; i++) {
	  	addEventListen(elements[i], type, handler);
	}
}
addEventListeners('input', 'focus', function (e) {
	this.parentNode.querySelector("span").style = "color:#000000";
	e.preventDefault();
});
addEventListeners('input', 'blur', function (e) {
	this.parentNode.querySelector("span").style = "color:#cfcfcf";
	e.preventDefault();
});
