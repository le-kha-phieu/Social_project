const pElement = document.getElementById("chooseImageButton");
const inputElement = document.getElementById("inputImageBlog");
const imagePreview = document.getElementById("imagePreview");

inputElement.style.display = "none";

pElement.addEventListener("click", function () {
  inputElement.click();
});

inputElement.addEventListener("change", function () {
  const selectedFileName = inputElement.value.split('\\').pop();

  if (selectedFileName) {
    const file = inputElement.files[0];

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const imageUrl = e.target.result;
        imagePreview.innerHTML = `<img src="${imageUrl}" alt="Image Preview">`;
        imagePreview.style.display = 'block';
      };

      reader.readAsDataURL(file);
    }
  } else {
    imagePreview.innerHTML = "";
    imagePreview.style.display = 'none';
  }
});



