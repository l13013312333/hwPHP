
function cambiar_login() {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_login";  
document.querySelector('.cont_form_login').style.display = "block";
document.querySelector('.cont_form_sign_up').style.opacity = "0";
document.querySelector('.cont_form_forget_password').style.opacity = "0";                  

setTimeout(function(){  document.querySelector('.cont_form_login').style.opacity = "1"; },400);  
  
setTimeout(function(){    
document.querySelector('.cont_form_sign_up').style.display = "none";
},200);
setTimeout(function(){   document.querySelector('.cont_form_forget_password').style.display = "none";
},400);  
  }
  
function ready_login(){
	var id = document.getElementById("ID").value;
	var pwd = document.getElementById("PWD").value;
	
}

function cambiar_sign_up(at) {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_sign_up";
  document.querySelector('.cont_form_sign_up').style.display = "block";
document.querySelector('.cont_form_login').style.opacity = "0";
  
setTimeout(function(){  document.querySelector('.cont_form_sign_up').style.opacity = "1";
},100);  

setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
},400);  
setTimeout(function(){   document.querySelector('.cont_form_forget_password').style.display = "none";
},400);  

}
  
function cambiar_forget_password(at) {
  document.querySelector('.cont_forms').className = "cont_forms cont_forms_active_forget_password";
  document.querySelector('.cont_form_forget_password').style.display = "block";
document.querySelector('.cont_form_login').style.opacity = "0";
  
setTimeout(function(){  document.querySelector('.cont_form_forget_password').style.opacity = "1";
},100);  

setTimeout(function(){   document.querySelector('.cont_form_login').style.display = "none";
},400);  

setTimeout(function(){   document.querySelector('.cont_form_sign_up').style.display = "none";
},400);  
}


function ocultar_login_sign_up() {

document.querySelector('.cont_forms').className = "cont_forms";  
document.querySelector('.cont_form_sign_up').style.opacity = "0";               
document.querySelector('.cont_form_login').style.opacity = "0";             
document.querySelector('.cont_form_forget_password').style.opacity = "0";


setTimeout(function(){
document.querySelector('.cont_form_sign_up').style.display = "none";
document.querySelector('.cont_form_login').style.display = "none";
document.querySelector('.cont_form_forget_password').style.display = "none";
},500);  
  
  }