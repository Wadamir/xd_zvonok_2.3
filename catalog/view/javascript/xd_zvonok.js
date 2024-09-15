document.addEventListener("DOMContentLoaded", () => {
    console.log('XD Zvonok DOM loaded');
    
    btnZvonokEvents();

    getCaptcha();
});

const getCaptcha = () => {
    const url = 'index.php?route=extension/module/xd_zvonok/get_captcha';
    fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data['captcha']) {
            console.log('captcha success');
            console.log(data['captcha']);
        }
    });

}
const btnZvonokEvents = () => {
    const buttons = document.getElementsByClassName('xd_zvonok_btn');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', () => {
            const modal = $('#xd_zvonok_modal');
            const info_url = 'index.php?route=extension/module/xd_zvonok/info';
            fetch(info_url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data['error']) {
                    return;
                }
                modal.html(data['success']);
                modal.modal('show');
                formEvents();
                inputEvents();
                phoneEvents();
            })
        });
    }
}
const formEvents = () => {
    const form = document.getElementById('xd_zvonok_form');
    if (!form) return;
    form.addEventListener('submit', (e) => {
        submitForm();
        e.preventDefault();
    });
}
const inputEvents = () => {
    const inputs = document.getElementsByClassName('xd_zvonok_input');
    for (let i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('focus', () => {
            let input = inputs[i];
            let parent = input.parentElement;
            parent.classList.remove('has-error');
        });
    }
}
const phoneEvents = () => {
    const phoneInputs = document.getElementById('xd_zvonok_phone');
    if (!phoneInputs) return;

    phoneInputs.addEventListener('keyup', (e) => {
        let phone = phoneInputs.value;
        let pattern = new RegExp(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/);
        if (!pattern.test(phone)) {
            let parent = phoneInputs.parentElement;
            parent.classList.add('has-error');
        } else {
            let parent = phoneInputs.parentElement;
            parent.classList.remove('has-error');
        }
    });

}
const submitForm = () => {
    console.log('XD Zvonok submit form');

    const form = document.getElementById('xd_zvonok_form');
    if (!form) return;

    const submit_btn = form.querySelector('button[type=submit]');
    if (!submit_btn || submit_btn.disabled) return;

    const value_text = submit_btn.innerText;
    const waiting_text = 'SENDING';
    submit_btn.disabled = true;
    submit_btn.classList.add('disabled');
    submit_btn.innerText = waiting_text;

    const url = 'index.php?route=extension/module/xd_zvonok/submit';
    const data = new FormData(form);
    try {
        fetch(url, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data['error']) {
                let all_errors = data['error'];
                for (let i = 0; i < Object.keys(all_errors).length; i++) {
                    let key = Object.keys(all_errors)[i];
                    let value = all_errors[key];
                    let input = form.querySelector(`input[name=${key}]`);
                    if (input) {
                        let input_parent = input.parentElement;
                        input_parent.classList.add('has-error');
                        let error_el = document.getElementById(key + '_error');
                        if (error_el) {
                            error_el.innerText = value;
                            error_el.classList.remove('hidden');
                        }
                    }
                    let textarea = form.querySelector(`textarea[name=${key}]`);
                    if (textarea) {
                        let textarea_parent = textarea.parentElement;
                        textarea_parent.classList.add('has-error');
                        let error_el = document.getElementById(key + '_error');
                        if (error_el) {
                            error_el.innerText = value;
                            error_el.classList.remove('hidden');
                        }
                    }
                }
                submit_btn.innerText = 'ERROR';
                setTimeout(() => {
                    submit_btn.disabled = false;
                    submit_btn.classList.remove('disabled');
                    submit_btn.innerText = value_text;
                }, 3000);
            }
            if (data['success']) {
                let success = true;
                form.reset();
                submit_btn.classList.remove('disabled');
                submit_btn.innerText = value_text;
                submit_btn.disabled = false;
                $('#xd_zvonok_modal').modal('hide');
                $('#xd_zvonok_modal').on('hidden.bs.modal', () => {
                    if (success) {
                        $('#xd_zvonok_success').modal('show');
                        setTimeout(() => {
                            console.log('success sending!');
                            $('#xd_zvonok_success').modal('hide');
                        }, 4000);
                        success = false;
                    }
                });
            }
        })
    } catch (error) {
        console.error(error);
        submit_btn.disabled = false;
        submit_btn.classList.remove('disabled');
        submit_btn.innerText = 'ERROR';
        setTimeout(() => {
            submit_btn.innerText = value_text;
        }, 3000);
    }
}
/*
window.onload = function() {
    $('#xd_zvonok-form').submit(function(event) {
		event.preventDefault ? event.preventDefault() : (event.returnValue = false);
		if(!formValidation(event.target)){return false;}
		var sendingForm = $(this);
		var submit_btn = $(this).find('button[type=submit]');
		var value_text = $(submit_btn).text();
		var waiting_text = 'SENDING';
		$.ajax({
			url: 'index.php?route=extension/module/xd_zvonok/submit',
			type: 'post',
			data: $('#xd_zvonok-form input[type=\'hidden\'], #xd_zvonok-form input[type=\'text\'], #xd_zvonok-form input[type=\'tel\'], #xd_zvonok-form input[type=\'email\'], #xd_zvonok-form textarea'),
			dataType: 'json',
			beforeSend: function() {
				$(submit_btn).prop( 'disabled', true );
				$(submit_btn).addClass('waiting').text(waiting_text);
			},
			complete: function() {
				$(submit_btn).button('reset');
			},
			success: function(json) {
				console.log(json);
				if (json['error']) {
					$(submit_btn).prop( 'disabled', false );
					$(submit_btn).removeClass('waiting').text("ERROR");
					setTimeout(function(){
						$(submit_btn).delay( 3000 ).text(value_text);
					}, 3000);
				}

				if (json['success']) {
					var success = true;
					$(sendingForm).trigger('reset');
					$(submit_btn).removeClass('waiting');
					$(submit_btn).text(value_text);
					$(submit_btn).prop( 'disabled', false );
					$('#xd_zvonok_modal').modal('hide');
					$('#xd_zvonok_modal').on('hidden.bs.modal', function (e) {
						if (success) {
							$('#xd_zvonok_success').modal('show');
							setTimeout(function(){
									console.log('success sending!');
									$('#xd_zvonok_success').modal('hide');
							}, 4000);
							success = false;
						}
					});
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				$(submit_btn).prop( 'disabled', false );
				$(submit_btn).removeClass('waiting').text("ERROR");
				setTimeout(function(){
					$(submit_btn).delay( 3000 ).text(value_text);
				}, 3000);				
			}
		});
		event.preventDefault();
    });
});
function formValidation(formElem){
	var elements = $(formElem).find('.required');
	var errorCounter = 0;
	
	$(elements).each(function(indx,elem){
		var placeholder = $(elem).attr('placeholder');
		if($.trim($(elem).val()) == '' || $(elem).val() == placeholder){
			$(elem).parent().addClass('has-error');
			errorCounter++;
		} else {
			$(elem).parent().removeClass('has-error');
		}
	});

	$(formElem).find('input[type=tel]').each(function() {
		var pattern = new RegExp(/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/);
		var data_pattern = $(this).attr('data-pattern');
		var data_placeholder = $(this).attr('placeholder');
		if (!pattern.test($(this).val()) || $.trim($(this).val()) == '' ) {
			$('input[name="phone"]').parent().addClass('has-error');
			errorCounter++;
		} else {
			$(this).parent().removeClass('has-error');
		}
	});
	
	if (errorCounter > 0) {
		return false;
	} else {
		return true;
	}
}
*/

/*
sbjs.init({
    callback: placeData
});

function placeData(sb) {
    document.getElementById('sb_first_typ').value       = sb.first.typ;
    document.getElementById('sb_first_src').value       = sb.first.src;
    document.getElementById('sb_first_mdm').value       = sb.first.mdm;
    document.getElementById('sb_first_cmp').value       = sb.first.cmp;
    document.getElementById('sb_first_cnt').value       = sb.first.cnt;
    document.getElementById('sb_first_trm').value       = sb.first.trm;

    document.getElementById('sb_current_typ').value     = sb.current.typ;
    document.getElementById('sb_current_src').value     = sb.current.src;
    document.getElementById('sb_current_mdm').value     = sb.current.mdm;
    document.getElementById('sb_current_cmp').value     = sb.current.cmp;
    document.getElementById('sb_current_cnt').value     = sb.current.cnt;
    document.getElementById('sb_current_trm').value     = sb.current.trm;

    document.getElementById('sb_first_add_fd').value    = sb.first_add.fd;
    document.getElementById('sb_first_add_ep').value    = sb.first_add.ep;
    document.getElementById('sb_first_add_rf').value    = sb.first_add.rf;

    document.getElementById('sb_current_add_fd').value  = sb.current_add.fd;
    document.getElementById('sb_current_add_ep').value  = sb.current_add.ep;
    document.getElementById('sb_current_add_rf').value  = sb.current_add.rf;

    document.getElementById('sb_session_pgs').value     = sb.session.pgs;
    document.getElementById('sb_session_cpg').value     = sb.session.cpg;

    document.getElementById('sb_udata_vst').value       = sb.udata.vst;
    document.getElementById('sb_udata_uip').value       = sb.udata.uip;
    document.getElementById('sb_udata_uag').value       = sb.udata.uag;

    document.getElementById('sb_promo_code').value      = sb.promo.code;
}
*/