const inputAvatar = document.querySelector('.upload-avatar-user')
const uploadImage = document.querySelector('.avatar-profile')

inputAvatar.addEventListener('change', function () {
    const file = inputAvatar.files[0]

    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader()

        reader.onload = function (e) {
            const imageUrl = e.target.result
            console.log(imageUrl)
            document.querySelector('.avatar-profile').setAttribute('src', `${imageUrl}`)
        }

        reader.readAsDataURL(file);
    }
})

const btnEdit = document.querySelector('.btn-edit');
const uploadAvatar = document.querySelector('.btn-upload-avatar');
const editUserName = document.querySelector('.user-name-text');
const inputUserName = document.querySelector('.input-user-name');
const btnSave = document.querySelector('.btn-save');

// Thêm sự kiện click từ JavaScript
btnEdit.addEventListener('click', function () {
    // Thêm lớp CSS để hiển thị input và button Save
    uploadAvatar.style.display = 'block';
    inputUserName.style.display = 'block';
    editUserName.style.display = 'none';
    btnSave.style.display = 'block';

    // Ẩn nút "Edit Profile"
    btnEdit.style.display = 'none';
});
