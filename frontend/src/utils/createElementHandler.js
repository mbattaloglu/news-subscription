function createResultText(status, text) {
  const resultBox = document.querySelector(".subscription-form__result-box");
  if (!status || !text || !resultBox) return;

  let textElement = document.createElement("div");

  switch (status) {
    case "success":
      textElement.classList += "subscription-form__text_success";
      break;
    case "fail":
      textElement.classList += "subscription-form__text_error";
  }
  
  textElement.innerText += text;
  resultBox.append(textElement);
}

function createErrorNotifier(text, parent) {
  if (!text || !parent) return;

  const modal = document.createElement("div");
  modal.classList += "subscription-form__modal_error";
  modal.innerText += text;

  //If already exists
  const existingModal = parent.querySelector(".subscription-form__modal_error");
  if (existingModal) parent.removeChild(existingModal);

  parent.append(modal);
}
