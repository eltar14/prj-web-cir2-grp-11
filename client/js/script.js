id_user = document.getElementById('id_user').innerText; 



ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, getName);

function getName(name){ // récupère le nom de l'utilisateur et l'affiche dans le HTML
    document.getElementById('nav_name_user').innerText = name;
    document.getElementById('nameUserInput').value = name;
}
// ==========



ajaxRequest('GET', 'php/request.php/surname_user/?id_user=' + id_user, getSurnameDelay); //Envoie la requête surname_user vers le fichier request.php et récupère l'id de l'utilisateur


function getSurnameDelay(surname){ 
    setTimeout(getSurname, 50, surname);
}
function getSurname(surname){ // récupère le nom de l'utilisateur et l'affiche dans le HTML
    let name = document.getElementById('nav_name_user').innerText;
    let fullName = name + ' ' + surname;
    document.getElementById('nav_name_user').innerText = fullName;
    document.getElementById('surnameUserInput').value = surname;


}

// ========== POUR LES CARDS

function createCard(title, description, imageSrc, buttonText, buttonUrl) { // Créer une carte Bootstrap
    var card = document.createElement("div");
    card.className = "card";
    card.style.width = '300';
    
    var image = document.createElement("img");
    image.className = "card-img-top";
    image.src = imageSrc;
    image.alt = title;
    
    var cardBody = document.createElement("div");
    cardBody.className = "card-body";
    
    var cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;
    
    var cardText = document.createElement("p");
    cardText.className = "card-text";
    cardText.textContent = description;
    
    var button = document.createElement("a");
    button.className = "btn btn-primary";
    button.textContent = buttonText;
    button.href = buttonUrl;
    
    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(button);
    
    card.appendChild(image);
    card.appendChild(cardBody);
    
    return card;
  }



  var card = createCard(
    "Titre de la carte", //Titre de la carte
    "Description de la carte", //Description de la carte
    "chemin/vers/image.jpg", //chemin/vers/image.jpg
    "Bouton", //Bouton
    ""
  );
  
// ==========

ajaxRequest('GET', 'php/request.php/email_user/?id_user=' + id_user, getEmail); //Envoie la requête email_user vers le fichier request.php et récupère l'email de l'utilisateur

function getEmail(email){ //Renvoie la valeur de l'email de l'utilisateur dans le HTML
    document.getElementById('emailUserInput').value = email;
}

// ==========


function displayNameUserModal(name){ // Renvoie le prénom de l'utilisateur dans le modal
    document.getElementById('nameUserInput').value = name;
}
function displaySurnameUserModal(surname){ // Renvoie le nom de l'utilisateur dans le modal
    document.getElementById('surnameUserInput').value = surname;
}
function displayEmailUserModal(email){ // Renvoie l'email de l'utilisateur dans le modal
    document.getElementById('emailUserInput').value = email;
}

function displayFormerPasswordUserModal(password){ // Renvoie l'ancien mot de passe de l'utilisateur dans le modal
    document.getElementById('formerPasswordUserInput').value = formerPassword;
}
function displayPasswordUserModal(password){ // Renvoie le nouveau mot de passe de l'utilisateur dans le modal
    document.getElementById('passwordUserInput').value = password;
}
function displayBirthDateUserModal(birthdate){ // Renvoie la date de naissance de l'utilisateur dans le modal
    document.getElementById('birthdateUserInput').value = birthdate;
}


$('#submitChangeUserInfo').on('click', () =>
    {
        console.log('click on submitChangeUserInfo button')

        ajaxRequest('PUT', 'php/request.php/update_name/', ()=>{}, 'id_user='+ id_user +'&name_user='+ document.getElementById('nameUserInput').value); //effectue la requête update_name vers le fichier request.php	et modifie le nom de l'utilisateur en fonction de son id
        getName(document.getElementById('nameUserInput').value)

        ajaxRequest('PUT', 'php/request.php/update_surname/', ()=>{}, 'id_user='+ id_user +'&surname_user='+ document.getElementById('surnameUserInput').value); // effectue la requête update_surname vers le fichier request.php et modifie le prénom de l'utilisateur en fonction de son id
        getSurname(document.getElementById('surnameUserInput').value)


        ajaxRequest('PUT', 'php/request.php/update_email/', ()=>{}, 'id_user='+ id_user +'&email_user='+ document.getElementById('emailUserInput').value); // effectue la requête update_email vers le fichier request.php et modifie l'email de l'utilisateur en fonction de son id
        getEmail(document.getElementById('emailUserInput').value)

        ajaxRequest('PUT', 'php/request.php/update_password/', ()=>{}, 'id_user='+ id_user +'&password_user='+ document.getElementById('passwordUserInput').value + '&former_password_user=' + document.getElementById('formerPasswordUserInput').value); // effectue la requête update_password vers le fichier request.php et modifie le mot de passe de l'utilisateur en fonction de son id
        document.getElementById('formerPasswordUserInput').value = '';
        document.getElementById('passwordUserInput').value = '';

        ajaxRequest('PUT', 'php/request.php/update_birthdate/', ()=>{}, 'id_user='+ id_user +'&birthdate_user='+ document.getElementById('birthdateUserInput').value); // effectue la requête update_birthdate vers le fichier request.php et modifie la date de naissance de l'utilisateur en fonction de son id
        
    }
);

$('#go_search').on('click', (e) =>
    {
        e.preventDefault();
        console.log('click search');
        let searched_value = document.getElementById('search_value').value; // récupère la valeur de la barre de recherche
        console.log(searched_value);
        let type = document.querySelector('input[name="options"]:checked').value; // récupère la valeur du type de recherche
        console.log(type);

        switch (type){
            case 'album':
                ajaxRequest('GET', 'php/request.php/search_album/?search=' + searched_value, display_album_cards); // effectue la requête search_album vers le fichier request.php et affiche les cartes des albums correspondants
                break;
            case 'artist':
                ajaxRequest('GET', 'php/request.php/search_artist/?search=' + searched_value, display_artist_cards); // effectue la requête search_artist vers le fichier request.php et affiche les cartes des artistes correspondants
                break;
            case 'title':
                ajaxRequest('GET', 'php/request.php/search_song/?search=' + searched_value +'&id_user=' + id_user, display_song_cards); // effectue la requête search_song vers le fichier request.php et affiche les cartes des chansons correspondants
                break;
        }
        setTimeout(() => {
            document.getElementById('accordion_recherche').classList.add('active'); // active l'accordéon
            let panel = document.getElementById('accordion_recherche').nextElementSibling; 
            panel.style.maxHeight = panel.scrollHeight + "px";

        }, 200);



    }
);


$('#search_album').on('click', () =>
    {
        $('#go_search').click();
    }
);


$('#search_artist').on('click', () =>
    {
        $('#go_search').click();
    }
    );


$('#search_titre').on('click', () =>
    {
        $('#go_search').click();
    }
);
// Song results

// ========== CAROUSELS ==========

// ===== SONG =====

function display_song_cards(values, r = false, oid = false){ // Affiche les cartes des chansons
    let id = r?'carouselSongA':'carouselSongB';
    if (oid){
        id = 'carouselSongC';
    }
    let str = '';
    let total_length = values.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="' + id + '" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_song_card(values[pos]['title_song'],
                    values[pos]['name_album'],
                    values[pos]['cover_album'],
                    'Ecouter',
                    values[pos]['link_song'],
                    values[pos]['id_song'],
                    values[pos]['is_liked']
                    )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    if(r){
        return str;
    }else{
        document.getElementById("search_results_div").innerHTML = str;
    }

}

function create_song_card(title, description, image_src, button_text, button_url, id_song, is_liked){ // Crée une carte de chanson

    let card = document.createElement("div");
    card.className = "card";

    let image = document.createElement("img");
    image.className = "card-img-top";
    image.src = image_src;
    image.alt = title;

    let cardBody = document.createElement("div");
    cardBody.className = "card-body";

    let cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;

    let cardText = document.createElement("p");
    cardText.className = "card-text";
    cardText.textContent = description;

    let button1 = document.createElement("a");
    let button1inner = document.createElement("button");

    button1inner.className = "btn btn-primary go_listen";
    button1.href = button_url;
    button1inner.textContent = button_text;
    button1inner.value = id_song;
    button1.appendChild(button1inner);

    let button2 = document.createElement("button");
    button2.className = "btn like_button";
    button2.type = "button";
    button2.value = id_song;

    if (is_liked){
        button2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart-fill" viewBox="0 0 16 16">\n' +
            '                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>\n' +
            '                </svg>';
        button2.classList.add('filled');
    }else {
        button2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-heart" viewBox="0 0 16 16">\n' +
            '  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>\n' +
            '</svg>';
        button2.classList.remove('filled');
    }
    let button3 = document.createElement("button");
    button3.className = "btn playlist_button";
    button3.type = "button";
    button3.value = id_song;
    button3.setAttribute('data-bs-target', '#modalPlaylist')
    button3.setAttribute('data-bs-toggle', 'modal')
    button3.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-plus-circle" viewBox="0 0 16 16">\n' +
        '                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>\n' +
        '                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>\n' +
        '                </svg>';

    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(button1);
    cardBody.appendChild(button2);
    cardBody.appendChild(button3);

    card.appendChild(image);
    card.appendChild(cardBody);

    let div = document.createElement("div");
    div.appendChild(card);
    return div.innerHTML;
}

// ===== ALBUM =====
function display_album_cards(values){ // Affiche les cartes d'albums
    let str = '';
    let total_length = values.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="carouselAlbums" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_album_card(values[pos]['name_album'],
                    values[pos]['date_album'],
                    values[pos]['name_artist'],
                    values[pos]['cover_album'],
                    values[pos]['id_album'],
                )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAlbums" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next" type="button" data-bs-target="#carouselAlbums" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    document.getElementById("search_results_div").innerHTML = str;
}

function create_album_card(title, date_album, name_artist, image_src, id_album){ // Crée une carte d'album
    let card = document.createElement("div");
    card.className = "card";

    let image = document.createElement("img");
    image.className = "card-img-top";
    image.src = image_src;
    image.alt = title;

    let cardBody = document.createElement("div");
    cardBody.className = "card-body";

    let cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;

    let cardText1 = document.createElement("p");
    cardText1.className = "card-text";
    cardText1.textContent = name_artist;

    let cardText2 = document.createElement("p");
    cardText2.className = "card-text";
    cardText2.textContent = date_album;

    let button1 = document.createElement("button");
    button1.className = "btn btn-primary album_info_btn";
    button1.value = id_album;
    button1.setAttribute('data-bs-target', '#modalAlbum');
    button1.setAttribute('data-bs-toggle', 'modal');
    button1.innerHTML = '\n' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">\n' +
        '  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>\n' +
        '  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>\n' +
        '</svg>';



    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText1);
    cardBody.appendChild(cardText2);
    cardBody.appendChild(button1);
    card.appendChild(image);
    card.appendChild(cardBody);

    let div = document.createElement("div");
    div.appendChild(card);
    return div.innerHTML;
}



// ===== ARTIST =====
function display_artist_cards(values){ // Affiche les cartes d'artistes

    let str = '';
    let total_length = values.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="carouselArtists" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_artist_card(values[pos]['name_artist'],
                    values[pos]['description_artist'],
                    'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png',
                    values[pos]['id_artist']
                )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev" type="button" data-bs-target="#carouselArtists" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next" type="button" data-bs-target="#carouselArtists" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    document.getElementById("search_results_div").innerHTML = str;
}

function create_artist_card(title, description, image_src, id_artist){ // Crée une carte d'artiste
    let card = document.createElement("div");
    card.className = "card";

    let image = document.createElement("img");
    image.className = "card-img-top";
    image.src = image_src;
    image.alt = title;

    let cardBody = document.createElement("div");
    cardBody.className = "card-body";

    let cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;

    let cardText = document.createElement("p");
    cardText.className = "card-text";
    cardText.textContent = description;

    let button1 = document.createElement("button");
    button1.className = "btn btn-primary artist_info_btn";
    button1.value = id_artist;
    button1.setAttribute('data-bs-target', '#modalArtist')
    button1.setAttribute('data-bs-toggle', 'modal')
    button1.innerHTML = '\n' +
        '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">\n' +
        '  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>\n' +
        '  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>\n' +
        '</svg>';

    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(button1);
    card.appendChild(image);
    card.appendChild(cardBody);

    let div = document.createElement("div");
    div.appendChild(card);
    return div.innerHTML;
}

// ===== PLAYLIST =====

function display_playlists_cards(playlists){ // Affiche les cartes de playlists
    let str = '';
    let total_length = playlists.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="carouselPlaylists" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += createPlaylistCard(playlists[pos]['name_playlist'],
                    playlists[pos]['date_playlist'],
                    playlists[pos]['cover_playlist'],
                    playlists[pos]['id_playlist'],
                    playlists[pos]['is_fav']
                )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPlaylists" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next" type="button" data-bs-target="#carouselPlaylists" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    document.getElementById("playlists").innerHTML = str;
}
function createPlaylistCard(title, date, cover_url, id_playlist, is_fav){
    let card = document.createElement("div");
    card.className = "card";

    let image = document.createElement("img");
    image.className = "card-img-top";
    image.src = cover_url;
    image.alt = title;

    let cardBody = document.createElement("div");
    cardBody.className = "card-body";

    let cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;

    let cardText = document.createElement("p");
    cardText.className = "card-text";
    cardText.textContent = date;

    let btn_container = document.createElement('div');
    btn_container.style.display = "flex";
    btn_container.style.justifyContent = "space-between";


    let button_more = document.createElement("button");
    button_more.type = 'button';
    button_more.className = 'btn btn-primary more_playlist_button';
    button_more.value = id_playlist;
    button_more.setAttribute('data-bs-target', '#modalPlaylistInfos')
    button_more.setAttribute('data-bs-toggle', 'modal')
    button_more.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">\n' +
        '  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>\n' +
        '  <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>\n' +
        '</svg>';

    let button_delete = document.createElement("button");
    button_delete.type = 'button';
    button_delete.className = 'btn btn-danger btn-sm delete_playlist_button';
    button_delete.value = id_playlist;
    button_delete.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
        '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>\n' +
        '  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>\n' +
        '</svg>';


    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    btn_container.appendChild(button_more);
    if (!is_fav){
        btn_container.appendChild(button_delete);
    }

    cardBody.appendChild(btn_container);
    card.appendChild(image);
    card.appendChild(cardBody);

    let div = document.createElement("div");
    div.appendChild(card);
    return div.innerHTML;
}







function display_song_cards_in_playlist_modal(values, id_html = 'carouselPlaylistsGestion'){ // Affiche les cartes des musiques contenues dans une playlist
    let id = String(id_html);
    let str = '';
    let total_length = values.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="' + id + '" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';
    console.error(total_length);
    for (let i = 0; i < nbr; i++) {

        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_song_card_in_playlist_display(values[pos]['title_song'],
                    values[pos]['name_album'],
                    values[pos]['cover_album'],
                    'Ecouter',
                    values[pos]['link_song'],
                    values[pos]['id_song'],
                    values[pos]['id_playlist']
                )
            }
        }
        str += '</div>\n' +
            '            </div>';
    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';
        return str;
}
function create_song_card_in_playlist_display(title, title_album, image_src, button_text, button_url, id_song, id_playlist){

    let card = document.createElement("div");
    card.className = "card";

    let image = document.createElement("img");
    image.className = "card-img-top";
    image.src = image_src;
    image.alt = title;

    let cardBody = document.createElement("div");
    cardBody.className = "card-body";

    let cardTitle = document.createElement("h5");
    cardTitle.className = "card-title";
    cardTitle.textContent = title;

    let cardText = document.createElement("p");
    cardText.className = "card-text";
    cardText.textContent = title_album;

    let button1 = document.createElement("a");
    let button1inner = document.createElement("button");

    button1inner.className = "btn btn-primary go_listen";
    button1.href = button_url;
    button1inner.textContent = button_text;
    button1inner.value = id_song;
    button1.appendChild(button1inner);

    let button2 = document.createElement("button");
    button2.type = 'button';
    button2.className = 'btn btn-danger btn-sm delete_song_from_playlist_button';
    button2.value = id_song;
    button2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">\n' +
        '  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>\n' +
        '  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>\n' +
        '</svg>';


    let button3 = document.createElement("button");
    button3.value = id_playlist;
    button3.style.display = 'none';
    button3.className = 'id_playlist_gestion_playlist';

    // Ajouter les éléments à la carte
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardText);
    cardBody.appendChild(button1);
    cardBody.appendChild(button2);
    cardBody.appendChild(button3);

    card.appendChild(image);
    card.appendChild(cardBody);

    let div = document.createElement("div");
    div.appendChild(card);
    return div.innerHTML;
}

// ===== HISTORY =====

function display_history_cards(values, r = false, oid = false){ // affiche les cartes des musiques écoutées récemment

    let id = 'carouselHistory';
    let str = '';
    let total_length = values.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="' + id + '" class="carousel slide carousel-dark" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_song_card(values[pos]['title_song'],
                    values[pos]['name_album'],
                    values[pos]['cover_album'],
                    'Ecouter',
                    values[pos]['link_song'],
                    values[pos]['id_song'],
                    values[pos]['is_liked']
                    )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next btn-outline-light" type="button" data-bs-target="#' + id + '" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    if(r){
        return str;
    }else{
        document.getElementById("history").innerHTML = str;
    }

}

$('#printArtistInfo').on('click', () =>
    {
        console.log('click on printArtistInfo button')

        let id_artist = document.getElementById('id_artist').innerText;
        console.log(id_artist);

        ajaxRequest('GET', 'php/request.php/artist/?id_artist=' + id_artist, ()=>{}); // lorsque le bouton est cliqué on récupère l'id de l'artiste
    }
);


//search_results_div

$('#search_results_div').on('click', '.artist_info_btn', () =>
    {
        console.log($(event.target).closest('.artist_info_btn').attr('value'));
        let id_artist = $(event.target).closest('.artist_info_btn').attr('value'); 
        ajaxRequest('GET', 'php/request.php/name_artist/?id_artist=' + id_artist, displayModalInfoArtistName); // lorsque le bouton est cliqué on récupère le nom de l'artiste
        ajaxRequest('GET', 'php/request.php/description_artist/?id_artist=' + id_artist, displayModalDescriptionArtist);  // lorsque le bouton est cliqué on récupère la description de l'artiste
        ajaxRequest('GET', 'php/request.php/type_artist/?id_artist=' + id_artist, displayModalTypeArtist); // lorsque le bouton est cliqué on récupère le type de l'artiste
        ajaxRequest('GET', 'php/request.php/get_all_album/?id_artist=' + id_artist, displayModalAlbumsArtist); // lorsque le bouton est cliqué on récupère les albums de l'artiste

    }
);
//delete_playlist_button
// $('body').on('click', '.album_info_btn', () =>
//     {
//         console.log($(event.target).closest('.album_info_btn').attr('value'));
//         let id_album = $(event.target).closest('.album_info_btn').attr('value');
//         console.warn('azerty');
//         ajaxRequest('GET', 'php/request.php/all_album/?id_album=' + id_album, displayModalInfoAlbumName);
//     }
// );

function displayModalInfoArtistName(nameArtist){ // affiche le nom de l'artiste dans la modal
    document.getElementById('nameArtist').innerText = nameArtist;
}

function displayModalDescriptionArtist(descriptionArtist){ // affiche la description de l'artiste dans la modal
    document.getElementById('descriptionArtist').innerText = descriptionArtist;
}

function displayModalTypeArtist(typeArtist){ // affiche le type de l'artiste dans la modal
    document.getElementById('typeArtist').innerText = typeArtist;
}

function displayModalAlbumsArtist(albumsArtist){ // affiche les albums de l'artiste dans la modal
    let str = '';
    let total_length = albumsArtist.length;
    let nbr = Math.ceil(total_length/5);
    str += '<div id="carouselAllAlbum" class="carousel carousel-dark slide" data-bs-ride="carousel">\n' +
        '        <div class="carousel-inner">';

    for (let i = 0; i < nbr; i++) {
        if (i === 0){
            str += '<div class="carousel-item active">' +
                '<div class="cards-wrapper">';
        } else {
            str += '<div class="carousel-item">\n' +
                '                <div class="cards-wrapper">';
        }

        for (let j = 0; j < 5; j++) {
            if (((i)*5 + j+1) <= total_length){
                let pos = 5*i + j;
                str += create_album_card(albumsArtist[pos]['name_album'],
                    albumsArtist[pos]['date_album'],
                    albumsArtist[pos]['name_artist'],
                    albumsArtist[pos]['cover_album'],
                    albumsArtist[pos]['id_album']
                )
            }

        }
        str += '</div>\n' +
            '            </div>';

    }
    str += '</div>\n' +
        '        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAllAlbum" data-bs-slide="prev">\n' +
        '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Previous</span>\n' +
        '        </button>\n' +
        '        <button class="carousel-control-next" type="button" data-bs-target="#carouselAllAlbum" data-bs-slide="next">\n' +
        '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
        '            <span class="visually-hidden">Next</span>\n' +
        '        </button>\n' +
        '    </div>';

    document.getElementById("all_album_modal_carousel").innerHTML = str;
}



$('body').on('click', '.album_info_btn', () =>
    {
        console.log($(event.target).closest('.album_info_btn').attr('value'));
        let id_album = $(event.target).closest('.album_info_btn').attr('value')
        ajaxRequest('GET', 'php/request.php/all_album/?id_album=' + id_album, displayModalInfoAlbumName); //lorsque que le bouton d'info d'un album est cliqué on récupère les infos de l'album
    }
);

function displayModalInfoAlbumName(album_infos){
    document.getElementById('nameAlbum').innerText = album_infos['name_album']; // affiche le nom de l'album dans la modal
    document.getElementById('dateAlbum').innerText = album_infos['date_album']; // affiche la date de l'album dans la modal
    document.getElementById('styleAlbum').innerText = album_infos['style_album']; // affiche le style de l'album dans la modal
    let id_album = album_infos['id_album'];
    ajaxRequest('GET', 'php/request.php/songs_album/?id_album=' + id_album + '&id_user=' + id_user, aux) //on récupère toutes les musiques de l'album

    function aux(songs){
        document.getElementById('album_modal_carousel').innerHTML = display_song_cards(songs, true, true); // on affiche les musiques de l'album dans la modal sous forme de carrousels
    }
}


/**
 * === display liked songs at page loading ===
 */
function display_liked_songs(){ // affiche les musiques likées par l'utilisateur
    ajaxRequest('GET', 'php/request.php/fav_user/?id_user=' + id_user, aux2); // on récupère les musiques likées par l'utilisateur
    function aux2(songs){
        document.getElementById('liked_songs').innerHTML = display_song_cards(songs, true); 
        setTimeout(() => {
            document.getElementById('accordion_likes').classList.add('active');
            let panel = document.getElementById('accordion_likes').nextElementSibling;
            panel.style.maxHeight = panel.scrollHeight + "px";

        }, 100);
    }
}
display_liked_songs();


/**
 * === display users playlists at page loading ===
 */
function display_playlists(){ // requete ajax afficher les playlists dans l'accordéon
    ajaxRequest('GET', 'php/request.php/playlists_user/?id_user=' + id_user, aux3);

}
display_playlists();

/**
 * permet d'ajouter les cartes des playlists dans l'accordeon playlists
 * @param playlists
 */
function aux3(playlists){
    //document.getElementById('playlists').innerHTML = playlists;

    display_playlists_cards(playlists);
    setTimeout(() => {          //remet à la bonne taille au cas où une partie des cards ne passe pas sur l'axe vertical, ou quand l'accordeon est fermé
        document.getElementById('accordion_playlists').classList.add('active');
        let panel = document.getElementById('accordion_playlists').nextElementSibling;
        panel.style.maxHeight = panel.scrollHeight + "px";

    }, 100);
}

/**
 * onclick bouton like : déclenche l'ajout aux titres likés et l'update de l'affichage
 */
$('body').on('click', '.like_button', () =>
    {
        let btn = $(event.target).closest('.like_button');
        let id_song = btn.attr('value');        // récupère l'id de la musique via la value du bouton
        //console.log(id_song);
        btn.toggleClass('filled');  //change la classe du bouton concernant le visuel du coeur rempli ou non
        if (btn.hasClass('filled')){    //change l'aspect en fonction de la classe
            btn.html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart-fill" viewBox="0 0 16 16">\n' +
            '                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>\n' +
            '                </svg>');
        }else{
            btn.html('<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-heart" viewBox="0 0 16 16">\n' +
                '  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>\n' +
                '</svg>');
        }


        ajaxRequest('POST', 'php/request.php/add_fav/', ()=>{}, 'id_user='+ id_user + '&id_song=' +  id_song);
        setTimeout((id_song) => {   //actions multiples après l'ajout en BDD
            display_liked_songs();               // update de l'affichage
            update_like_footer(id_song, id_user);
            $('#go_search').click();
        }, 100, id_song);
    }
);

/**
 * oncklick bouton + playlist via card song
 */
$('body').on('click', '.playlist_button', () =>
{
    let btn = $(event.target).closest('.playlist_button');
    let id_song = btn.attr('value');
    //console.log(id_song);

    $('#create_new_playlist_button').val(id_song);  //met l'id de la musique dont provient le clic dans le bouton de la fenêtre modale
    ajaxRequest('GET', 'php/request.php/playlists_user/?id_user=' + id_user, display_playlists_in_modal);
}
);

/**
 * onclick bouton infos playlist du carousel des playlists
 */
$('body').on('click', '.more_playlist_button', () =>
{
    let btn = $(event.target).closest('.more_playlist_button');
    let id_playlist = btn.attr('value');
    console.log('info playlist id : ',id_playlist);
    ajaxRequest('GET', 'php/request.php/get_playlist_content/?id_playlist=' + id_playlist, set_modal_display_playlist_content);
}
);

/**
 * affichage des playlists dans l'accordeon playlist
 * @param data
 */
function set_modal_display_playlist_content(data){
    //console.warn(data);
    document.getElementById('id_playlist_gestion_modal').innerHTML = display_song_cards_in_playlist_modal(data);
}
// onclick bouton delete playlist / song from playlist


/**
 * click bouton delete song from playlist
 */
$('body').on('click', '.delete_song_from_playlist_button',() => //onclick suppression musique d'une playlist
    {
        let btn = $(event.target).closest('.delete_song_from_playlist_button');
        let id_song = btn.attr('value');                                                // récupère l'id de la musique
        let id_playlist = btn.next('.id_playlist_gestion_playlist').attr('value'); // récupère l'id de la playlist
        //console.log("del song from playlist ids, idp : ", id_song+' , '+ id_playlist);

        ajaxRequest('DELETE', 'php/request.php/delete_song_from_playlist/'+ id_playlist +'/'+ id_song +'/', ()=>{});
        setTimeout(() => {
            ajaxRequest('GET', 'php/request.php/get_playlist_content/?id_playlist=' + id_playlist, set_modal_display_playlist_content); // a mettre en callback
        }, 400);
    }
);


/**
 * click bouton delete playlist
 */
$('body').on('click', '.delete_playlist_button', () =>
{
    let btn = $(event.target).closest('.delete_playlist_button');
    let id_playlist = btn.attr('value');
    console.log('delete playlist id : ',id_playlist);
    ajaxRequest('DELETE', 'php/request.php/delete_playlist/'+ id_playlist +'/', display_playlists);
    setTimeout(() => {
        display_playlists()
    }, 400);
}
);

/**
 *  affichage des playlists dans le modal
 * @param playlists
 */
function display_playlists_in_modal(playlists){
    let card_div = document.createElement("div");
    card_div.style.width = '18rem';
    card_div.className = 'card';




    let ul = document.createElement("ul");
    ul.className = "list-group list-group-flush";

    for (const playlist of playlists) {
        let li = document.createElement('li');
        li.className = "list-group-item";


        let title = document.createElement("h6");
        title.innerText = playlist['name_playlist'];
        li.appendChild(title);


        let button_add = document.createElement("button");
        button_add.type = "button";
        button_add.className = "btn btn-primary btn-sm button_add_to_playlist";
        button_add.innerText = "Ajouter";
        button_add.value = playlist['id_playlist'];

        li.appendChild(button_add);


        ul.appendChild(li);

    }
    card_div.appendChild(ul);

    document.getElementById('div_gestion_playlist_modal').innerHTML = "";
    document.getElementById('div_gestion_playlist_modal').appendChild(card_div);


}

/**
 * onclick bouton create new playlist (dans la modale de gestion playlist via card song)
 */
$('#create_new_playlist_button').on('click', () =>
    {
        let playlist_name = $('#new_playlist_name').val();
        let cover_url = $('#new_playlist_cover_url').val();
        ajaxRequest('POST', 'php/request.php/add_playlist/', ()=>{}, 'id_user='+ id_user + '&name_playlist=' +  playlist_name + '&new_playlist_cover_url=' +cover_url);

        setTimeout(() => {
            display_playlists();

            ajaxRequest('GET', 'php/request.php/playlists_user/?id_user=' + id_user, display_playlists_in_modal);

        }, 700);
    }
);

/**
 *  onclick bouton d'ajout d'une musique à une playlist
 */
$('#div_gestion_playlist_modal').on('click', '.button_add_to_playlist', () =>
    {
        let id_playlist = $(event.target).closest('.button_add_to_playlist').attr('value');
        let id_song = $('#create_new_playlist_button').attr('value');
        console.warn('id_playlist : ', id_playlist, 'id_song : ', id_song);
        ajaxRequest('POST', 'php/request.php/add_song_to_playlist/', ()=>{}, 'id_playlist='+ id_playlist + '&id_song=' +  id_song);
    }
);


/**
 *  désactive le submit sur appui ENTER
 *  (évite le rechargement de la page)
 */
$('#form_search').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
        e.preventDefault();
        return false;
    }
});


/**
 * onclick bouton lecture de la carte d'une musique
 */
$('body').on('click', '.go_listen', (e) => {
    e.preventDefault();
    console.log($(event.target).closest('.go_listen').attr('value'));
    let id_song = $(event.target).closest('.go_listen').attr('value');

    ajaxRequest('GET', 'php/request.php/get_song_infos/?id_song=' + id_song+ '&id_user=' + id_user, play_song);

    ajaxRequest('POST', 'php/request.php/add_to_history/', display_history, 'id_user=' + id_user + '&id_song=' + id_song);
    setTimeout(() => {
        display_history();
        document.getElementById('player_bar').style.display = 'block';
    }, 100);
});

/**
 * lecture d'une musique + actualisation de la barre de lecture en bas de l'écran
 *
 *  array song en entrée avec au moins link_song, title_song, name_artist, id_song, bool is_liked
 * @param song
 */
function play_song(song){
    //console.warn('play_song : ', song);
    document.getElementById('audio_player').src = song['link_song'];
    let img_cover = document.createElement("img");
    img_cover.style.maxHeight = '3em';
    img_cover.src = song['cover_album'];
    document.getElementById('footer_cover_image').innerHTML = '';
    document.getElementById('footer_cover_image').appendChild(img_cover);

    document.getElementById('now_playing').innerText = song['title_song'];  //
    document.getElementById('now_playing_artist_name').innerText = song['name_artist'];
    document.getElementById('now_playing_like_button').value = song['id_song'];
    document.getElementById('now_playing_playlist_button').value = song['id_song'];
    document.getElementById('now_playing_playlist_button').setAttribute('data-bs-target', '#modalPlaylist')
    document.getElementById('now_playing_playlist_button').setAttribute('data-bs-toggle', 'modal')
    if (song['is_liked']){      // couleur de remplissage du coeur si liké ou non
        document.getElementById('now_playing_like_button').classList.add('filled');
        document.getElementById('now_playing_like_button').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart-fill" viewBox="0 0 16 16">\n' +
                                                                '                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>\n' +
                                                                '                </svg>';
    }else{
        document.getElementById('now_playing_like_button').innerHTML ='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-heart" viewBox="0 0 16 16">\n' +
                                                                                '  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>\n' +
                                                                                '</svg>';
    }
}

/**
 *  appelle update_like_footer_aux via callback
 * @param id_song
 * @param id_user
 */
function update_like_footer(id_song, id_user){
    ajaxRequest('GET', 'php/request.php/get_song_infos/?id_song=' + id_song+ '&id_user=' + id_user, update_like_footer_aux);
}

/**
 * met à jour le remplissage du coeur du player
 * @param arg le tableau de get_song_infos
 */
function update_like_footer_aux(arg){
    let is_liked = arg['is_liked'];
    document.getElementById('now_playing_like_button').classList.toggle('filled');
    if (is_liked){
        document.getElementById('now_playing_like_button').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart-fill" viewBox="0 0 16 16">\n' +
            '                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>\n' +
            '                </svg>';
    }else{
        document.getElementById('now_playing_like_button').innerHTML ='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-heart" viewBox="0 0 16 16">\n' +
            '  <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>\n' +
            '</svg>';
    }
}

/**
 * affichage de l'historique
 */
function display_history() {
    ajaxRequest('GET', 'php/request.php/history_user/?id_user=' + id_user, aux4);
    function aux4(history) {
        console.warn(history);
        $('#history').html(history);
    
        display_history_cards(history);
    
        setTimeout(() => {
            $('#accordion_history').addClass('active');
            let panel = $('#accordion_history').next().get(0);
            panel.style.maxHeight = panel.scrollHeight + 'px';
        }, 100);
    }
}
display_history();



// fait une recherche de musique avec une str vide pour avoir un affichage
// dans l'accordéon recherche lors du chargement de la page
document.getElementById('go_search').click();
