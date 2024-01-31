function changeButtonStatus(status) {
  const submitBtn = document.querySelector("#submit-btn");
  if (!submitBtn || !status) return;

  switch (status) {
    case "loading":
      submitBtn.disabled = true;
      submitBtn.innerText = "Loading";
      break;
    case "default":
      submitBtn.disabled = false;
      submitBtn.innerText = "Subscribe";
      break;
  }
}
