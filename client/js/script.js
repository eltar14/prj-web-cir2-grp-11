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

// ========== POUR LES CARDS

function createCard(title, description, imageSrc, buttonText, buttonUrl) {
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
                ajaxRequest('GET', 'php/request.php/search_album/?search=' + searched_value, display_album_cards);
                break;
            case 'artist':
                ajaxRequest('GET', 'php/request.php/search_artist/?search=' + searched_value, display_artist_cards);
                break;
            case 'title':
                ajaxRequest('GET', 'php/request.php/search_song/?search=' + searched_value, display_song_cards);
                break;
        }
        setTimeout(() => {
            document.getElementById('accordion_recherche').classList.add('active');
            let panel = document.getElementById('accordion_recherche').nextElementSibling;
            panel.style.maxHeight = panel.scrollHeight + "px";

        }, 100);



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
function display_song_cards2(values){
    div1 = document.createElement("div");
    div1.id = 'carouselExampleControls';



}

function display_song_cards(values, r = false){
    let id = r?'carouselSongA':'carouselSongB';
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
                    values[pos]['link_song'])
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
function display_album_cards(values){
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

function create_album_card(title, date_album, name_artist, image_src, id_album){
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





// album['name_album'], album['name_artist'], album['cover_album'], 'Voir', ''
function display_artist_cards(values){

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

function create_artist_card(title, description, image_src, id_artist){
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
function create_song_card(title, description, image_src, button_text, button_url){
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
    button1.className = "btn btn-primary";
    button1.textContent = button_text;
    button1.href = button_url;

    let button2 = document.createElement("button");
    button2.className = "btn";
    button2.type = "button";
    button2.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-heart-fill" viewBox="0 0 16 16">\n' +
        '                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"></path>\n' +
        '                </svg>';



    let button3 = document.createElement("button");
    button3.className = "btn";
    button3.type = "button";
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


$('#printArtistInfo').on('click', () =>
    {
        console.log('click on printArtistInfo button')

        let id_artist = document.getElementById('id_artist').innerText;
        console.log(id_artist);

        ajaxRequest('GET', 'php/request.php/artist/?id_artist=' + id_artist, rien(1));
    }
);


//search_results_div

$('#search_results_div').on('click', '.artist_info_btn', () =>
    {
        console.log($(event.target).closest('.artist_info_btn').attr('value'));
        let id_artist = $(event.target).closest('.artist_info_btn').attr('value')
        ajaxRequest('GET', 'php/request.php/name_artist/?id_artist=' + id_artist, displayModalInfoArtistName);
    }
);


function displayModalInfoArtistName(nameArtist){
    document.getElementById('nameArtist').innerText = nameArtist;
}






$('#search_results_div').on('click', '.album_info_btn', () =>
    {
        console.log($(event.target).closest('.album_info_btn').attr('value'));
        let id_album = $(event.target).closest('.album_info_btn').attr('value')
        ajaxRequest('GET', 'php/request.php/all_album/?id_album=' + id_album, displayModalInfoAlbumName);
    }
);

function displayModalInfoAlbumName(album_infos){
    document.getElementById('nameAlbum').innerText = album_infos['name_album'];
    document.getElementById('dateAlbum').innerText = album_infos['date_album'];
    document.getElementById('styleAlbum').innerText = album_infos['style_album'];
    let id_album = album_infos['id_album'];
    console.warn(id_album);
    ajaxRequest('GET', 'php/request.php/songs_album/?id_album=' + id_album, aux)

    function aux(songs){
        document.getElementById('album_modal_carousel').innerHTML = display_song_cards(songs, true);
    }


}

//$(event.target).closest('.artist_info_btn').attr('value')

/*

function printt(val){
    document.getElementById('nav_name_user').innerText = val;
}

ajaxRequest('PUT', 'php/request.php/update_name/', printt, 'id_user='+ id_user +'&name_user=polooo');

ajaxRequest('GET', 'php/request.php/name_user/?id_user=' + id_user, printt);*/

// let search = 'paul';
// ajaxRequest('GET', 'php/request.php/search_album/?search=' + search, console.warn);


/*
document.getElementById("search_results_div").appendChild(createCard("Test1 card",
    "Une belle description lorem ipsum dolor sit amet.",
    'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Cat03.jpg/1200px-Cat03.jpg',
    'Voir',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3a/Cat03.jpg/1200px-Cat03.jpg'))*/
