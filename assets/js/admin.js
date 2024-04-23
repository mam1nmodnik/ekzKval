$(document).ready(function() {
    updateInfo()
});

const updateInfo = () => {
    let div = document.querySelector('#userStatements');
    $.ajax({
        url: 'vendor/updateSpisok.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {  
            div.innerHTML = ' ';
            response.map(el => {
                let statusText = '';
                   if(el.stat === "1"){
                    statusText = 'Не прочитана'
                   }else if(el.stat === "2"){
                    statusText = 'Подтверждена'
                   }else if(el.stat === "3"){
                    statusText = 'Отклонена'
                   }
                div.innerHTML += `
                <div class="relative" data-id="${el.id}">
                    <div class="container__content">
                        <div>
                            <h1>Регистрационный номер</h1>
                            <p>${el.reg_number}</p>
                        </div> 
                        <div>
                            <h1>Описание нарушения</h1>
                            <p>${el.description}</p>
                        </div> 
                    </div>
                    <div>
                        <button type="submit" name="accept"  class="accept"> Принять</button>
                        <button type="submit" name="reject" class="reject"> Отклонить</button>
                    </div>
                    <div class="status">
                        <p>Статус: ${statusText}</p>
                    </div>
                </div>
                `;
                }
            );
        }
    });
}


setTimeout(() => {

    $('.accept').click(function(e) {
        e.preventDefault();
        let id = $(this).closest('.relative').data('id'); // Получаем идентификатор записи
        let stat = 2; // Устанавливаем новое значение статуса
        console.log(id);
        let newId = toString(id);
        $.ajax({
            url: 'vendor/updateStatement.php',
            type: 'POST',
            dataType: 'json',
            data: { id: newId, status: stat },
            success: function(response) {
                // Проверяем успешность операции и обновляем страницу, если необходимо
                if (response.status === true) {
                    updateInfo(); // Повторно загружаем данные после изменения
                    console.log(response)
                } else {
                    console.error('Ошибка при обновлении записи');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка AJAX-запроса:', error);
            }
        });
    });

    $('.reject').click( function (e) {
        e.preventDefault();  
        let id = $(this).closest('.relative').data('id'); // Получаем идентификатор записи
        let stat = 3;
        console.log(id);
        $.ajax({
            url: 'vendor/updateStatement.php',
            type: 'POST',
            dataType: 'json',
            data: { id: id, status: stat },
            success: function(response) {
                // Проверяем успешность операции и обновляем страницу, если необходимо
                if (response.status === true) {
                    updateInfo(); // Повторно загружаем данные после изменения
                    console.log(response)
                } else {
                    console.error('Ошибка при обновлении записи');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ошибка AJAX-запроса:', error);
            }
        });
    })

}, 1000)

