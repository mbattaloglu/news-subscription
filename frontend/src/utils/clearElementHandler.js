function clearModalErrors(from) {
  if (!from) return;

  Array.from(from.querySelectorAll(".subscription-form__modal_error")).forEach(
    (m) => {
      from.removeChild(m);
    }
  );
}

function clearResultBox() {
  const resultBox = document.querySelector(".subscription-form__result-box");
  if (!resultBox) return;

  Array.from(resultBox.children).forEach((child) => {
    if (child.classList.contains("btn")) return; //Don't remove the submit button

    resultBox.removeChild(child);
  });
}
