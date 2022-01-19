let myInput_email = document.getElementById("email");
let myInput = document.getElementById("password_field");
let letter = document.getElementById("letter");
let capital = document.getElementById("capital");
let number = document.getElementById("number");
let length = document.getElementById("length");
let specials = document.getElementById("specials");
let email_correct = document.getElementById("email_message");


myInput_email.onfocus = function() {
    document.getElementById("message_email").style.display = "block";
    document.getElementById("message").style.display = "none";
}
myInput_email.onblur = function() {
    document.getElementById("message_email").style.display = "none";
}

myInput_email.onkeyup = function() {
    let correct_email = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    if (correct_email.test(myInput_email.value) === true) {
        email_correct.classList.remove("invalid");
        email_correct.classList.add("valid");
    } else {
        email_correct.classList.remove("valid");
        email_correct.classList.add("invalid");
    }
}

    myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
        document.getElementById("message_email").style.display = "none";

}
    myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}
    myInput.onkeyup = function() {
    let lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) {
        letter.classList.remove("invalid");
        letter.classList.add("valid");
} else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}
    let upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) {
        capital.classList.remove("invalid");
        capital.classList.add("valid");
} else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
}
    let numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {
        number.classList.remove("invalid");
        number.classList.add("valid");
} else {
    number.classList.remove("valid");
    number.classList.add("invalid");
}
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
} else {
    length.classList.remove("valid");
    length.classList.add("invalid");
}
    let specialsymb = /^[^-() /]*$/g;
    if(myInput.value.match(specialsymb)) {
        specials.classList.remove("invalid");
        specials.classList.add("valid");
    } else {
        specials.classList.remove("valid");
        specials.classList.add("invalid");
        }
}
let btn = document.getElementById('btn')
myInput.onblur = myInput_email.onblur = function submit_active(){
    if(specials.classList.contains('valid') && length.classList.contains('valid') && number.classList.contains('valid') &&
        capital.classList.contains('valid') && letter.classList.contains('valid') && email_correct.classList.contains('valid')){
        btn.removeAttribute('disabled')
    }
    else{
        btn.setAttribute('disabled', true)
    }
}