const username = document.getElementById("username");
const name = document.getElementById("name");
const email = document.getElementById("email");
const password = document.getElementById("password");
const passwordRepeat = document.getElementById("passwordRepeat");
const title = document.getElementById("title");

let validateUsername = () => {
  let regex = /^[a-zA-Z]([0-9a-zA-Z]){1,10}$/;
  let str = username.value;
  if (regex.test(str)) {
    username.classList.remove("is-invalid");
    username.classList.add("is-valid");
    return true;
  }
  username.classList.add("is-invalid");
  username.classList.remove("is-valid");
  return false;
};

let validateName = () => {
  let regex = /^[a-zA-Z]([\sa-zA-Z]){1,20}$/;
  let str = name.value;
  if (regex.test(str)) {
    name.classList.remove("is-invalid");
    name.classList.add("is-valid");
    return true;
  }
  name.classList.add("is-invalid");
  name.classList.remove("is-valid");
  return false;
};

let validateEmail = () => {
  let regex = /^([_\-\.a-zA-Z0-9]+)@([_\-\.a-zA-Z0-9]+)\.([a-zA-Z]){2,7}$/;
  let str = email.value;
  if (regex.test(str)) {
    email.classList.remove("is-invalid");
    email.classList.add("is-valid");
    return true;
  }
  email.classList.add("is-invalid");
  email.classList.remove("is-valid");
  return false;
};

let validatePassword = () => {
  let regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
  let str = password.value;
  if (regex.test(str)) {
    password.classList.remove("is-invalid");
    password.classList.add("is-valid");
    return true;
  }
  password.classList.add("is-invalid");
  password.classList.remove("is-valid");
  return false;
};

let validatePasswordRepeat = () => {
  let str = passwordRepeat.value;
  console.log(str);
  if (str === password.value && str.length > 0) {
    passwordRepeat.classList.remove("is-invalid");
    passwordRepeat.classList.add("is-valid");
    return true;
  }
  // if (str.length === 0) {
  //   passwordRepeat.classList.remove("is-invalid");
  //   passwordRepeat.classList.add("is-valid");
  // } else {
  //   passwordRepeat.classList.add("is-invalid");
  //   passwordRepeat.classList.remove("is-valid");
  // }

  passwordRepeat.classList.add("is-invalid");
  passwordRepeat.classList.remove("is-valid");
  return false;
};

let validateTitle = () => {
  let str = title.value;
  if (str.length > 0) {
    title.classList.remove("is-invalid");
    title.classList.add("is-valid");
    return true;
  }
  title.classList.add("is-invalid");
  title.classList.remove("is-valid");
  return false;

}

username.addEventListener("blur", validateUsername);
name.addEventListener("blur", validateName);
email.addEventListener("blur", validateEmail);
password.addEventListener("blur", validatePassword);
passwordRepeat.addEventListener("blur", validatePasswordRepeat);

let form = document.getElementById("myForm");
form.addEventListener("submit", (e) => {
  let validUsername = validateUsername();
  let validName = validateName();
  let validEmail = validateEmail();
  let validPassword = validatePassword();
  let validPasswordRepeat = validatePasswordRepeat();
  let validTitle = validateTitle();
  if (
    !validUsername ||
    !validName ||
    !validEmail ||
    !validPassword ||
    !validPasswordRepeat ||
    !validTitle
  ) {
    e.preventDefault();
  }
});
