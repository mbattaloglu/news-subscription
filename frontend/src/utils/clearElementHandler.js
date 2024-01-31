function clearModalErrors(from) {
  if (!from) return;
  
  Array.from(from.querySelectorAll(".subscription-form__modal_error")).map(
    (m) => {
      from.removeChild(m);
    }
  );
}

function clearResultBox() {
  const resultBox = document.querySelector(".subscription-form__result-box");

  Array.from(
    resultBox.querySelectorAll(".subscription-form__text_success")
  ).map((e) => {
    resultBox.removeChild(e);
  });

  Array.from(resultBox.querySelectorAll(".subscription-form__text_error")).map(
    (e) => {
      resultBox.removeChild(e);
    }
  );
}
