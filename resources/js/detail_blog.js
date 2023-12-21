const btnDelete = document.getElementById('btnDelete')
const closeFormIcon = document.getElementById('closeBox')
const cancelDeleteButton = document.getElementById('cancelBox')
const formDelete = document.getElementById('formBox')

btnDelete.addEventListener('click', function () {
    console.log(123)
    formDelete.style.display = 'block'
})

closeFormIcon.addEventListener('click', function () {
    formDelete.style.display = 'none'
})

cancelDeleteButton.addEventListener('click', function () {
    formDelete.style.display = 'none'
})
