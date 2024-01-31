const nameLabel = document.querySelector("#name-label");
const emailLabel = document.querySelector("#email-label");

const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");

const submitBtn = document.querySelector("#submit-btn");

const defaultBackgroundColor = "#eeeeee";
const errorBackgroundColor = "#fcd8d8";

function resetInputArea(input, label) {
  if (!input || !label) return;
  changeBacgroundColor(input, defaultBackgroundColor);
  clearModalErrors(label);
}

async function onSubmit(name, email) {
  if (!name || !email) {
    createResultText("fail", "You should provide name/email.");
    return;
  }

  changeButtonStatus("loading");

  clearModalErrors(nameLabel);
  clearModalErrors(emailLabel);

  await subscribe(name, email)
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
      changeButtonStatus("default");
    });
}

function createErrorIndicator(input, label, text) {
  changeBacgroundColor(input, errorBackgroundColor);
  createErrorNotifier(text, label);
  input.focus();
}

// Reset errors and background when inputting
nameInput.addEventListener("input", () => {
  resetInputArea(nameInput, nameLabel);
});

// Reset errors and background when inputting
emailInput.addEventListener("input", () => {
  resetInputArea(emailInput, emailLabel);
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
    validateName(nameText);
  } catch (e) {
    createErrorIndicator(nameInput, nameLabel, e.message);
    canBeSubmitted = false;
  }

  //Test email
  try {
    validateEmail(emailText);
  } catch (e) {
    createErrorIndicator(emailInput, emailLabel, e.message);
    canBeSubmitted = false;
  }

  if (canBeSubmitted) {
    onSubmit(nameText, emailText);
  }
});
