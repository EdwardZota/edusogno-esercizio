
//switch tra show e hide password

let eyeLogin = document.getElementById('eyeLogin');
let eyeRegistration = document.getElementById('eyeRegistration');

function ShowHidden(){
    let password = document.getElementById('password');
    if(password.type === 'password'){
        password.type = 'text';
    }else{
        password.type ='password';
    };
}
if(eyeLogin){
    eyeLogin.addEventListener('click',ShowHidden)
}
if(eyeRegistration){
    eyeRegistration.addEventListener('click',ShowHidden)
}