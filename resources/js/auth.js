const pElement = document.getElementById("choose-avatar-button");
const inputElement = document.getElementById("inputReAvartar");
inputElement.style.display = "none";

pElement.addEventListener("click", function () {
  inputElement.click();
});

inputElement.addEventListener("change", function () {
  const selectedFileName = inputElement.value.split('\\').pop();
  if (selectedFileName) {
    const headName = selectedFileName.slice(0, 30)
    const tailName = selectedFileName.slice(-4)
    pElement.textContent = headName + "..." + tailName;
    pElement.style.width = '100%'
  } else {
    pElement.textContent = "Choose avatar";
  }
});
