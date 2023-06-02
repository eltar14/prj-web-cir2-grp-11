id_user = document.getElementById('id_user').innerText;



ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, getName);

function getName(name){
    document.getElementById('nav_name_user').innerText = name;
    document.getElementById('nameUserInput').value = name;
}
// ==========



ajaxRequest('GET', 'php/request.php/surname_user/?id_user=' + id_user, getSurnameDelay);


function getSurnameDelay(surname){
    setTimeout(getSurname, 50, surname);
}
function getSurname(surname){
    let name = document.getElementById('nav_name_user').innerText;
    let fullName = name + ' ' + surname;
    document.getElementById('nav_name_user').innerText = fullName;
    document.getElementById('surnameUserInput').value = surname;


}
// ==========

ajaxRequest('GET', 'php/request.php/email_user/?id_user=' + id_user, getEmail);

function getEmail(email){
    document.getElementById('emailUserInput').value = email;
}

// ==========


function displayNameUserModal(name){
    document.getElementById('nameUserInput').value = name;
}
function displaySurnameUserModal(surname){
    document.getElementById('surnameUserInput').value = surname;
}
function displayEmailUserModal(email){
    document.getElementById('emailUserInput').value = email;
}

function rien(a){
    return;
}

$('#submitChangeUserInfo').on('click', () =>
    {
        console.log('click on submitChangeUserInfo button')

        ajaxRequest('PUT', 'php/request.php/update_name/', rien, 'id_user='+ id_user +'&name_user='+ document.getElementById('nameUserInput').value);
        getName(document.getElementById('nameUserInput').value)

        ajaxRequest('PUT', 'php/request.php/update_surname/', rien, 'id_user='+ id_user +'&surname_user='+ document.getElementById('surnameUserInput').value);
        getSurname(document.getElementById('surnameUserInput').value)


        ajaxRequest('PUT', 'php/request.php/update_email/', rien, 'id_user='+ id_user +'&email_user='+ document.getElementById('emailUserInput').value);
        getEmail(document.getElementById('emailUserInput').value)
    }
);

$('#go_search').on('click', () =>
    {
        console.log('click search');
        let searched_value = document.getElementById('search_value').value;
        console.log(searched_value);
        let type = document.querySelector('input[name="options"]:checked').value;
        console.log(type);

        switch (type){
            case 'album':
                ajaxRequest('GET', 'php/request.php/search_album/?search=' + searched_value, console.warn);
                break;
            case 'artist':
                ajaxRequest('GET', 'php/request.php/search_artist/?search=' + searched_value, console.warn);
                break;
            case 'title':
                ajaxRequest('GET', 'php/request.php/search_song/?search=' + searched_value, console.warn);
                break;
        }

    }
);

/*

function printt(val){
    document.getElementById('nav_name_user').innerText = val;
}

ajaxRequest('PUT', 'php/request.php/update_name/', printt, 'id_user='+ id_user +'&name_user=polooo');

ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, printt);*/

// let search = 'paul';
// ajaxRequest('GET', 'php/request.php/search_album/?search=' + search, console.warn);