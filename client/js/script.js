let id_user = document.getElementById('id_user').innerText;

ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, getName);

function getName(name){
    document.getElementById('nav_name_user').innerText = name;
    document.getElementById('nameUserInput').value = name;
}

ajaxRequest('GET', 'php/request.php/surname_user/?id_user=' + id_user, getSurname);

function getSurname(surname){
    let name = document.getElementById('nav_name_user').innerText;
    fullName = name + ' ' + surname;
    document.getElementById('nav_name_user').innerText = fullName;
    document.getElementById('surnameUserInput').value = surname;
}

