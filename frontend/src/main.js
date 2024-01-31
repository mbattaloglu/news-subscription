const nameLabel = document.querySelector("#name-label");
const emailLabel = document.querySelector("#email-label");

const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");

const submitBtn = document.querySelector("#submit-btn");

const defaultBackgroundColor = "#eeeeee";
const errorBackgroundColor = "#fcd8d8";

// Reset errors and background when inputting
nameInput.addEventListener("input", () => {
  changeBacgroundColor(nameInput, defaultBackgroundColor);
  clearModalErrors(nameLabel);
});

// Reset errors and background when inputting
emailInput.addEventListener("input", () => {
  changeBacgroundColor(emailInput, defaultBackgroundColor);
  clearModalErrors(emailLabel);
});

submitBtn.addEventListener("click", (e) => {
  //Don't refresh the page
  e.preventDefault();

  clearResultBox();

  const nameText = nameInput.value;
  const emailText = emailInput.value;

  let canBeSubmitted = true;

  //Test name
  try {
    const nameTest = validateName(nameText);
  } catch (e) {
    changeBacgroundColor(nameInput, errorBackgroundColor);
    createErrorNotifier(e.message, nameLabel);
    nameInput.focus();
    canBeSubmitted = false;
  }

  //Test email
  try {
    const emailTest = validateEmail(emailText);
  } catch (e) {
    changeBacgroundColor(emailInput, errorBackgroundColor);
    createErrorNotifier(e.message, emailLabel);
    emailInput.focus();
    canBeSubmitted = false;
  }

  if (canBeSubmitted) {
    submitBtn.disabled = true;
    submitBtn.innerText = "Loading";

    clearModalErrors(nameLabel);
    clearModalErrors(emailLabel);
    
    const formData = new FormData();
    formData.append("name", nameInput.value);
    formData.append("email", emailInput.value);

    fetch("http://localhost/news-subscription/subscribe/", {
      body: formData,
      method: "POST",
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          createResultText("success", data.message);
        } else {
          createResultText("fail", data.error);
        }
      })
      .catch((e) => {
        createResultText("fail", e.message);
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerText = "Subscribe";
      });
  }
});
