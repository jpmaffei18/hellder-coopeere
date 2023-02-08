function showTab(n) {
	// This function will display the specified tab of the form ...
	var x = $(".tab");
	$(x[n]).fadeIn(200);
	// ... and fix the Previous/Next buttons:
	if (n == 0) {
		$("#prevBtn").fadeOut(100);
	} else {
		$("#prevBtn").fadeIn(100);
	}
	if (n == (x.length - 1)) {
		$("#nextBtn").html("Finalizar");
	} else {
		$("#nextBtn").html('Próximo <i class="fas fa-chevron-right"></i>');
	}
	// ... and run a function that displays the correct step indicator:
	$('#form_tab').val(n);
}

function showCurrentTab(n) {
	// This function will figure out which tab to display
	var x = $(".tab");
	let active = parseInt($('.step.active').data('index'));
	// Exit the function if any field in the current tab is invalid:
	if (n == 1 && !validateForm()) return false;
	// Hide the current tab:
	$(x[active]).fadeOut(200);
	// Increase or decrease the current tab by 1:
	active = n;
	$('#form_tab').val(active);
	// if you have reached the end of the form... :
	if (active >= x.length) {
		//...the form gets submitted:
		$("#regForm").submit();
		return false;
	}
	// Otherwise, display the correct tab:
	showTab(active);
}

function nextPrev(n) {
	// This function will figure out which tab to display
	var x = document.getElementsByClassName("tab");
	let currentTab = parseInt($('.step.active').data('index'));
	// Exit the function if any field in the current tab is invalid:
	if (n == 1 && !validateForm()) return false;
	// Hide the current tab:
	$(x[currentTab]).fadeOut(200);
	// Increase or decrease the current tab by 1:
	currentTab = currentTab + n;
	$('#form_tab').val(currentTab);
	// if you have reached the end of the form... :
	if (currentTab >= x.length) {
		//...the form gets submitted:
		document.getElementById("regForm").submit();
		return false;
	}
	// Otherwise, display the correct tab:
	showTab(currentTab);
}

function validateForm() {
	// This function deals with validation of the form fields
	var x, y, i, valid = true;
	x = document.getElementsByClassName("tab");
	let currentTab = parseInt($('.step.active').data('index'));
	y = x[currentTab].getElementsByTagName("input");
	// A loop that checks every input field in the current tab:
	for (i = 0; i < y.length; i++) {
		// If a field is empty...
		if (y[i].value == "") {
			// add an "invalid" class to the field:
			y[i].className += " invalid";
			// and set the current valid status to false:
			//valid = false;
			valid = true;
		}
	}
	// If the valid status is true, mark the step as finished and valid:
	if (valid) {
		document.getElementsByClassName("step")[currentTab].className += " finish";
	}
	return valid; // return the valid status
}

function markTabs() {
	let n = parseInt($('.step.active').data('index'));
	for (i = 0; i <= n; i++) {
		$(".step").eq(i).addClass("finish");
	}
}

function addColorCheck() {
	$('input.opcao-pagamento-meio').closest('label.text-padrao').removeClass('text-padrao');
	$('input.opcao-pagamento-meio:checked').closest('label').addClass('text-padrao');
}

function copyToClipboard(element) {
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(element).val()).select();
	document.execCommand("copy");
	$temp.remove();
}

$(function () {
	$(document).on('change', 'input.opcao-pagamento-meio', function () {
		if ($(this).is(':checked')) {
			$(this).closest('.opcao-pagamento').find('input[name="periodicidade"]').prop("checked", true);
			addColorCheck()
		}
	});

	$(document).on('change', '[name="idoperadora"]', function () {
		$(this).closest('.operadora_field').find('label.checked').removeClass('checked');
		$(this).closest('label').addClass('checked');
	});

	$(document).on('click', '.btn-copy', function () {
		copyToClipboard($(this).data('target'));
	});

	$(document).on('click', '.step', function () {
		let time = 100;
		$('.step.active').removeClass('active');
		$(this).addClass('active');
		$('.tab').fadeOut(time);
		setTimeout(() => {
			showCurrentTab(parseInt($(this).data('index')));
		}, time);
	});

	$(document).on('click', '.btn-next-prev', function (e) {
		e.preventDefault();
		let action = 1;
		let ativo = $('.step.active');
		let index_novo = parseInt(ativo.index()) + 1;
		let time = 100;

		if ($(this).data('action') == 'prev') {
			action = parseInt(-1)
			index_novo = parseInt(ativo.index()) - 1;
		}

		ativo.removeClass('active');
		$('.step').eq(index_novo).addClass('active');
		$('.tab').eq(ativo.index()).fadeOut(100);
		setTimeout(() => {
			showCurrentTab(index_novo);
		}, time);
	});

	showCurrentTab(parseInt($('.step.active').data('index')));

	addColorCheck();
	markTabs();

});
