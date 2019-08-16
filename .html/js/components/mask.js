window.addEventListener('DOMContentLoaded', function () {
	function setCursorPosition(pos, elem) {
		elem.focus();
		if (elem.setSelectionRange) elem.setSelectionRange(pos, pos);
		else if (elem.createTextRange) {
			var range = elem.createTextRange();
			range.collapse(true);
			range.moveEnd('character', pos);
			range.moveStart('character', pos);
			range.select()
		}
	}
	
	function mask(event) {
		var matrix = '+7 (___) ___-__-__',
			i = 0,
			def = matrix.replace(/\D/g, ''),
			val = this.value.replace(/\D/g, '');
		if (def.length >= val.length) val = def;
		this.value = matrix.replace(/./g, function (a) {
			return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a
		});
		if (event.type == 'blur') {
			if (this.value.length == 2) this.value = ''
		} else setCursorPosition(this.value.length, this)
	};
	
	var input = document.getElementsByClassName('js-mask');
	for (var i = 0; i < input.length; i++) {
        input[i].addEventListener('input', mask, false);
		input[i].addEventListener('focus', mask, false);
		input[i].addEventListener('blur', mask, false);
    }
    
    function mask1(event) {
		var matrix = '____ - ____ - ____ - ____',
			i = 0,
			def = matrix.replace(/\D/g, ''),
			val = this.value.replace(/\D/g, '');
		if (def.length >= val.length) val = def;
		this.value = matrix.replace(/./g, function (a) {
			return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a
		});
		if (event.type == 'blur') {
			if (this.value.length == 2) this.value = ''
		} else setCursorPosition(this.value.length, this)
	};
	
	var input = document.getElementsByClassName('js-mask-card');
	for (var i = 0; i < input.length; i++) {
        input[i].addEventListener('input', mask1, false);
		input[i].addEventListener('focus', mask1, false);
		input[i].addEventListener('blur', mask1, false);
    }

});