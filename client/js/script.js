let id_user = document.getElementById('id_user').innerText;

ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, updateName);

function updateName(name){
    document.getElementById('nav_name_user').innerText = name;
}
