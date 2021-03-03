
//call ajax php page for sending message to office

function sendHello(){
	var name = $('#contact_name').val();
	var address = $('#contact_address').val();
	var email = $('#contact_email').val();
	var phone = $('#contact_phone').val();
	var message = $('#contact_message').val();
	
	if(trim(name) == '' || trim(name) == 'Name'){
		$('#info').html("* Nom et Prénom sont un champ obligatoire.");
		return false;	
	}
	
	if(trim(email) == '' || trim(email) == 'Email'){
		$('#info').html("* Adresse e-mail est un champ obligatoire.");	
		return false;	
	}
	
	if(trim(message) == '' || trim(message) == 'Message'){
		$('#info').html ("* Le message est un champ obligatoire.");	
		return false;	
	}		
	
	validate = validate_email(email);
	
	if(validate != '200'){
		$('#info').html("* Adresse e-mail semble être erronée.");	
		return false;
	}
	
	var pars ="name="+name+"&address="+address+"&email="+email+"&phone="+phone+"&message="+message;
	$.ajax({
			type: "POST",
			url: 'assets/php/send_message.php?type=contact',
			data: pars,
			dataType: 'text',
			beforeSend: ShowLoader,
			success: HideLoader,
			complete: CallAjaxResponse
	})
}



function CallAjaxResponse(){$('#info').html("Votre message a été envoyé. Je vous remercie.");}
function ShowLoader(){$('#info').html("<i>S'il vous plaît, attendez une seconde...</i>");}
function HideLoader(){$('#info').html("");}


function validate_email(email) {
  	var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9\.]{2,10})+$/.test(email);
  	if(reg == false) {
   		return '404'; // not valid
   	} else {
   		return '200'; // valid
   	}
}

function trim(str){
		trimed = str.replace(/^\s\s*/, "").replace(/\s\s*$/, "");
		return trimed;
}
