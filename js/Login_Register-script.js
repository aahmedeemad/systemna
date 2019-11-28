var register = document.getElementById('Register');
var card = document.getElementById('card');
var login = document.getElementById('login');
var signupform = document.getElementById('Signuptab');
var loginform =document.getElementById('Logintab');


register.onclick= function()
{
  login.classList.remove('selected');
  register.classList.add('selected');
  card.classList.add('extend');
  signupform.style.display='block';
  loginform.style.display='none';
  card.classList.remove('Logintab');
  card.classList.add('Signuptab');
  
};


login.onclick = function()
{
  login.classList.add('selected');
  register.classList.remove('selected');
  card.classList.remove('extend');
  signupform.style.display='none';
  loginform.style.display='block';
  card.classList.remove('Signuptab');
  card.classList.add('Logintab');
    
};


    
    