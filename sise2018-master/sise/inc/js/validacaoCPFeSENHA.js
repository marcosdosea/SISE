/**
 * Created by Daniel on 12/05/2017.
 */

var password = document.getElementById("password");
var confirm_password = document.getElementById("confirm_password");
var cpfD = document.getElementById("cpf");
var cpfLogin = document.getElementById("cpfLogin");

function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Senhas diferentes!");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function validarCpfCadastro() {
    cpf = cpfD.value;

    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
        cpfD.setCustomValidity("CPF Inválido!");
        return false;
    }
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);

    rev = 11 - (add % 11);

    if (rev == 10 || rev == 11)
        rev = 0;

    if (rev != parseInt(cpf.charAt(9))) {
        cpfD.setCustomValidity("CPF Inválido!");
        return false;
    }

    add = 0;

    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);

    rev = 11 - (add % 11);

    if (rev == 10 || rev == 11)
        rev = 0;

    if (rev != parseInt(cpf.charAt(10))) {
        cpfD.setCustomValidity("CPF Inválido!");
        console.log("Cpf invalido");
    } else {
        cpfD.setCustomValidity('');
        console.log("Cpf valido");
    }
}

function validarCpfLogin() {
    cpf = cpfLogin.value;

    if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
        cpfLogin.setCustomValidity("CPF Inválido!");
        return false;
    }
    add = 0;
    for (i = 0; i < 9; i++)
        add += parseInt(cpf.charAt(i)) * (10 - i);

    rev = 11 - (add % 11);

    if (rev == 10 || rev == 11)
        rev = 0;

    if (rev != parseInt(cpf.charAt(9))) {
        cpfLogin.setCustomValidity("CPF Inválido!");
        return false;
    }

    add = 0;

    for (i = 0; i < 10; i++)
        add += parseInt(cpf.charAt(i)) * (11 - i);

    rev = 11 - (add % 11);

    if (rev == 10 || rev == 11)
        rev = 0;

    if (rev != parseInt(cpf.charAt(10))) {
        cpfLogin.setCustomValidity("CPF Inválido!");
    } else {
        cpfLogin.setCustomValidity('');
    }
}

cpfD.onchange = validarCpfCadastro;
cpfLogin.onchange = validarCpfLogin;

//Função que restringi entradas numericas em <input>, esta sendo usado no CPF
function somenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;
    if((tecla>47 && tecla<58)) return true;
    else{
        if (tecla==8 || tecla==0) return true;
        else  return false;
    }
}

function alerta(){
    alert("EAE");
}