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

$('#printArtistInfo').on('click', () =>
    {
        console.log('click on printArtistInfo button')

        let id_artist = document.getElementById('id_artist').innerText;
        console.log(id_artist);

        ajaxRequest('GET', 'php/request.php/artist/?id_artist=' + id_artist, rien(1));
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