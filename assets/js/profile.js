

const updateName = (id) => {
    let name = $(`input[name="${id}"]`).val();
    console.log(name, id);
    const link = 'vendor/updateNameImage.php';
    const data = new FormData(); 

    data.append('id', id);
    data.append('name', name);

    fetch(link, {
        method: 'POST',
        body: data, 
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        alert(response.message)
        updateInfo()
    })
    .catch(error => console.error(error)); 
};


const deleteld = (id) => {
    const link = 'vendor/deletedPhoto.php';
    const data = new FormData(); 
    data.append('id', id);
    fetch(link, {
        method: 'POST',
        body: data, 
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        updateInfo()
        alert(response.message)
    })
    .catch(error => console.error(error));
};

const sendToUser = (idPhoto) => {

    const link = 'vendor/sendToUser.php';

    const linkPhoto = $(`img[name="${idPhoto}"]`)[0].src;
    const namePhoto = $(`input[name="${idPhoto}"]`).val();
    const sentByUserId = $(`div[id="userStatements"]`)[0].dataset.id;
    const select = document.getElementById(`${idPhoto}`)
    const userId = select.value;
    const sentUserName = $(`h2[id="usernname"]`)[0].dataset.id;
    
    const data = new FormData(); 
    data.append('namePhoto', namePhoto);
    data.append('linkPhoto', linkPhoto);
    data.append('sentByUserId', sentByUserId);
    data.append('sentUserName', sentUserName);
    data.append('userId', userId);
   
    fetch(link, {
        method: 'POST',
        body: data, 
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        alert(response.message)
        // console.log(response.message);
    })
    .catch(error => console.error(error.message));
};



function updateInfo() {

    let div = document.querySelector('#userStatements');
    
    $.ajax({
        url: 'vendor/photo.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {  
            div.innerHTML = '';
            const userId = response.user_id; 
            let dd;
            let lengthNull;  
                if(response.userData.length === 0){
                    lengthNull = `<option value="не найдено">Пользователя не найдено</option>`               
                }
                const userData = response.userData.map(elem => {
                     if (elem.id !== response.user_id){
                        return dd = `
                            <option value="${elem.id}">${elem.name}</option>
                            `
                     }
                })

            response.photosData.map(el => {
                if (el.userId === userId) {
                    div.innerHTML += `
                    <div class="card" data-id="${el.id}">
                        <div class="containter_img">
                        <img name="${el.id}" src="${el.link}" class="containter_img">
                        </div>
                        <div class="status">
                            <p class="colorName">Название: <input type="text" name="${el.id}" value="${el.name}" placeholder="${el.name}" required onchange="updateName(${el.id})" class="nameimg"></p>
                                <div class="content__send">
                                    <select name="select" id="${el.id}" data-id="${el.id}">
                                        <option value="" selected disabled hidden>Выберете пользователя</option>
                                        ${userData}
                                        ${lengthNull}
                                    </select>
                                    <button onclick="sendToUser(${el.id})" class="colorName buttonSend">Отправить фотокарточку</button>
                                </div>
                                <button style="margin-top: 20px;" onclick="deleteld(${el.id})" class="colorName">Удалить фотокарточку</button>
                        </div>
                    </div>
                    `;
                }
            });
        }
    });
}




$(document).ready(function() {
    updateInfo() 
});


$('.new-btn').click( function (e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    $('p[name="file"]').removeClass('error_p').text('');
    let file = $('input[name="file"]').prop('files')[0];
    id = document.querySelector('form[data-id]')
    tel = document.querySelector('form[data-tel]')
    console.log( id.dataset.id , tel.dataset.tel);
    let formData = new FormData();
    formData.append('file', file);
    formData.append('id', id.dataset.id);
    formData.append('tel', tel.dataset.tel);
    $.ajax({
        url: 'vendor/uploadFile.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success (response) { 
            const resp = JSON.parse(response)
           if(resp.status){
            updateInfo()
            alert(resp.message) 
           
           } else{
            alert(resp.message) 
           }
        }
    });
})
    
function getSentPhoto() {
    const link = 'vendor/getPhotosSentAndReceived.php';
    let div = document.querySelector('#userStatements');
    div.innerHTML = '';
    fetch(link, {
        method: 'GET',
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
        const userId = response.user_id; 
        response.photosData.map(el => {
            if (el.sentUserId === userId) {
               return div.innerHTML += `
                <div class="card2 sentContent" data-id="${el.id}">
                    <div class="containter_img">
                        <img src="${el.linkPhoto}" class="containter_img">
                        <p class="colorName">Название: ${el.namePhoto}</p> 
                    </div>    
                </div>
                `;
            }
        });
    })
    .catch(error => console.error(error.message)); 
}
function getReceivedPhoto() {
    const link = 'vendor/getPhotosSentAndReceived.php';
    let div = document.querySelector('#userStatements');
    div.innerHTML = '';
    fetch(link, {
        method: 'GET',
    })
    .then(response => {
        return response.json();
    })
    .then(response => {
       
        const userId = response.user_id; 
        response.photosData.map(el => {
            if (el.userId === userId) {
               return div.innerHTML += `
                <div class="card3 sentContent" data-id="${el.id}">
                    <p>Вы получили фотокарточку от ${el.sentUserName}</p>
                    <div class="containter_img">
                        <img src="${el.linkPhoto}" class="containter_img">
                        <p class="colorName">Название: ${el.namePhoto}</p> 
                    </div>    
                </div>
                `;
            }
        });
    })
    .catch(error => console.error(error.message)); 
}

const getPhotosSentAndReceived = (e) => {
   
    const allElements = document.querySelectorAll('.switch-menu p');
    allElements.forEach(element => {
        element.classList.remove('border-bottom');
    });

    e.target.classList.add('border-bottom');

    let div = document.querySelector('#userStatements');
    div.innerHTML = '';
    if(e.target.dataset.name === 'my') {
        updateInfo()
       
    }else if(e.target.dataset.name === 'sent'){
        getSentPhoto()
       
    } else if(e.target.dataset.name === 'received') {
        getReceivedPhoto()
      
    }
}

