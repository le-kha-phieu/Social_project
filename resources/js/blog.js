const pElement = document.getElementById("chooseImageButton")
const inputElement = document.getElementById("inputImageBlog")
const imagePreview = document.getElementById("imagePreview")

let currentImage = null

pElement.addEventListener("click", function () {
  inputElement.click()
})

inputElement.addEventListener("change", function () {
  const selectedFileName = inputElement.value.split('\\').pop()

  if (selectedFileName) {
    const file = inputElement.files[0]

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader()

      reader.onload = function (e) {
        const imageUrl = e.target.result
        currentImage = `<img src="${imageUrl}" alt="Image Preview">`
        imagePreview.innerHTML = currentImage
        imagePreview.style.display = 'block'
      }

      reader.readAsDataURL(file)
    }
  } else {
    if (currentImage) {
      imagePreview.innerHTML = currentImage
      imagePreview.style.display = 'block'
    } else {
      imagePreview.innerHTML = ""
      imagePreview.style.display = 'none'
    }
  }
})


