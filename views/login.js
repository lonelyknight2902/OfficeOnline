const username = document.getElementById("username");
const password = document.getElementById("password");

let validateUsername = () => {
  let regex = /^[a-zA-Z]([0-9a-zA-Z]){1,}$/;
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

username.addEventListener("blur", validateUsername);
password.addEventListener("blur", validatePassword);

let form = document.getElementById("myForm");
form.addEventListener("submit", (e) => {
  let validUsername = validateUsername();
  let validPassword = validatePassword();
  if (!validUsername || !validPassword) {
    e.preventDefault();
  }
});