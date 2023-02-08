require('./bootstrap');

$(() => {
	const $documento = $(".usuario-documento");

	const docOptions = {
		onKeyPress: (value, e, field, options) => {
			console.log(value);
			let newValue = value.replace(/\D/g, '');
			let masks = ["999.999.999-99", "99.999.999/9999-99"];
			let mask = (newValue.length < 12) ? masks[0] : masks[1];
			$documento.unmask();
			$documento.val(newValue);
			$documento.mask(mask, options);
		}
	};

	$documento.mask("999.999.999-99", docOptions);

	let $telefone = $(".usuario-telefone");

	const foneOptions = {
		onKeyPress: (value, e, field, options) => {
			console.log(value);
			let newValue = value.replace(/\D/g, '');
			let masks = ["(99) 99999-9999", "(99) 9999-9999"];
			let mask = (newValue.length < 10) ? masks[0] : masks[1];
			$documento.unmask();
			$documento.val(newValue);
			$documento.mask(mask, options);
		}
	};

	$telefone.mask("(99) 9999-9999", foneOptions);
});