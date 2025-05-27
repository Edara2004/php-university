function alertPass(){
    alert("Su usuario fué registrado con exito.")
}

function alertDecline(){
    alert("El registro de usuario es invalido.")
}

if (typeof registrationStatus !== 'undefined' && registrationStatus === true) {
    alertPass();
}

if (typeof registrationStatus !== 'undefined' && registrationStatus === true) {
    alertDecline();
}