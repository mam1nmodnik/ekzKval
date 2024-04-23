/*
    Авторизация
 */

 $('.login-btn').click( function (e) {
    e.preventDefault();
    $(`input`).removeClass('error');
    $('p[name="tel"]').removeClass('error_p').text('');
    $('p[name="password"]').removeClass('error_p').text('');
    let tel = $('input[name="tel"]').val(),
        password = $('input[name="password"]').val();
        const url = 'vendor/signin.php'
    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {
            tel: tel,
            password: password
        },
        success (response) {
           
            if (response.status) {
                if(response.role === 'admin') {
                    document.location.href = '/admin.php';
                }else{
                    document.location.href = '/ekzKval/profile.php';
                }
            } else {
                if (response.type === 1) {
                    response.fields.forEach(function (el) {
                        $(`input[name="${el.inp}"]`).addClass('error');
                        $(`p[name="${el.inp}"]`).addClass('error_p').text(el.message);
                    });
                }
                $('.msg').removeClass('none').text(response.message);
            }
        }
    });
});

/*
    Регистрация
*/

$('.register-btn').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');
    $('p[name="name"]').removeClass('error_p').text('');
    $('p[name="surname"]').removeClass('error_p').text('');
    $('p[name="password"]').removeClass('error_p').text('');
    $('p[name="tel"]').removeClass('error_p').text('');

    let name = $('input[name="name"]').val(),
        surname = $('input[name="surname"]').val(),
        password = $('input[name="password"]').val(),
        tel = $('input[name="tel"]').val()

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name, 
            surname: surname, 
            password: password,
            tel: tel,
        },
        success (response) {
            if (response.status) {
                document.location.href = '/ekzKval';
            } else {
                
                    response.fields.map(function (el) {
                        $(`input[name="${el.inp}"]`).addClass('error');
                       
                        $(`p[name="${el.inp}"]`).addClass('error_p').text(el.message);
                    });
                
                $('.msg').removeClass('none').text(response.message);
            }
        }
    });
});

