<?php

require_once('../../DB.php');
require_once ('User.php');
require_once ('Artist.php');
require_once ('Song.php');
require_once ('Album.php');

// Connection to the database
$db = DB::connexion();
if (!$db)
{
    header('HTTP/1.1 503 Service Unavailable');
    exit;
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$request = substr($_SERVER['PATH_INFO'], 1);
$request = explode('/', $request);
$requestRessource = array_shift($request);
//echo $requestRessource;

switch ($requestMethod){
    case "GET":
        get($db, $requestRessource);
    case "POST":
        post($db, $requestRessource);
    case "PUT":
        put($db, $requestRessource);
    case "DELETE":
        delete($db, $requestRessource, $request);
}

// ========= GET ==========
function get($db, $requestRessource)
{
    // Utilisateur
    if ($requestRessource == 'name_user') {
        $id_user =  $_GET["id_user"];
        $data = User::getName($id_user);
    }elseif ($requestRessource == 'surname_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getSurname($id_user);
    }elseif ($requestRessource == 'email_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getEmail($id_user);
    }elseif ($requestRessource == 'fav_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getLikedSongs($id_user);
    }elseif ($requestRessource == 'fav_id_list'){
        $id_user =  $_GET["id_user"];
        $data = User::getLikedSongs($id_user);
    }elseif ($requestRessource == 'playlists_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getPlaylistsList($id_user);
    }
    elseif ($requestRessource == 'history_user'){
        $id_user =  $_GET["id_user"];
        $data = User::getHistory($id_user);
    }

    // Artiste
    elseif ($requestRessource == 'all_artist'){
        $id_artist = $_GET["id_artist"];
        $data = Artist::getAll($id_artist);
    }elseif ($requestRessource == 'name_artist'){
        $id_artist = $_GET["id_artist"];
        $data = Artist::getName($id_artist);
    }elseif ($requestRessource == 'description_artist'){
        $id_artist = $_GET["id_artist"];
        $data = Artist::getDescription($id_artist);
    }elseif ($requestRessource == 'type_artist'){
        $id_artist = $_GET["id_artist"];
        $data = Artist::getType($id_artist);
    }elseif ($requestRessource == 'search_artist'){
        $val = $_GET["search"];
        $data = Artist::search($val);
    }

    // Album
    elseif ($requestRessource == 'search_album') {
        $val = $_GET["search"];
        $data = Album::search($val);
    }elseif ($requestRessource == 'all_album') {
        $val = $_GET["id_album"];
        $data = Album::getAll($val);
    }elseif ($requestRessource == 'songs_album') {
        $val = $_GET["id_album"];
        $id_user = $_GET["id_user"];
        $data = Album::getSongList($val, $id_user);
    }elseif ($requestRessource == 'get_all_album') {
        $id_artist = $_GET["id_artist"];
        $data = Album::getAllAlbum($id_artist);
    }

    // Musique
    elseif ($requestRessource == 'search_song') {
        $val = $_GET["search"];
        $id_user = $_GET["id_user"];
        $data = Song::search($val, $id_user);
    }elseif ($requestRessource == 'is_liked_by_user_song') {
        $id_user = $_GET["id_user"];
        $id_song = $_GET["id_song"];
        $data = Song::isLikedByUser($id_song, $id_user);
    }

    //Playlist
    elseif ($requestRessource == 'get_playlist_content') {
        $id_playlist = intval($_GET["id_playlist"]);
        $data = Playlist::getContent($id_playlist);
    }



    // Envoi de la réponse au client.
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('HTTP/1.1 200 OK');
    echo json_encode($data);
    exit();
}

// ========= POST ==========
function post($db, $requestRessource){
    // Utilisateur
    if($requestRessource == 'add_user'){
        if (isset($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["birthdate"], $_POST["password"])) {
            User::addUser($_POST["name"], $_POST["surname"], $_POST["email"], $_POST["birthdate"], $_POST["password"]);
            header('HTTP/1.1 201 Created');
            exit();
        }
    }elseif ($requestRessource == 'add_fav'){
        if (isset($_POST["id_user"], $_POST["id_song"])){
            User::addFav($_POST["id_user"], $_POST["id_song"]);
            header('HTTP/1.1 201 Created');
            exit();
        }
    }
    // Playlist
    elseif ($requestRessource == 'add_playlist'){
        if (isset($_POST["id_user"], $_POST["name_playlist"], $_POST["new_playlist_cover_url"])){
            Playlist::addPlaylist($_POST["id_user"], $_POST["name_playlist"], $_POST["new_playlist_cover_url"]);
            header('HTTP/1.1 201 Created');
            exit();
        }
    }elseif ($requestRessource == 'add_song_to_playlist'){
        if (isset($_POST["id_playlist"], $_POST["id_song"])){
            Playlist::addSong($_POST["id_playlist"], $_POST["id_song"]);
            header('HTTP/1.1 201 Created');
            exit();
        }
    }
    // Historique
    elseif ($requestRessource == 'add_to_history'){
        if (isset($_POST["id_user"], $_POST["id_song"])){
            User::addToHistory($_POST["id_user"], $_POST["id_song"]);
            header('HTTP/1.1 201 Created');
            exit();
        }
    }

    else{
        header('HTTP/1.1 xxx error');
        exit();
    }



}

// ========= PUT ==========
function put($db, $requestRessource){
    // Modification des données de l'utilisateur
    parse_str(file_get_contents('php://input'), $_PUT);
    if ($requestRessource == 'update_name'){
        if (isset($_PUT["id_user"], $_PUT["name_user"])){
            User::updateName($_PUT["id_user"], $_PUT["name_user"]);
        }

    }elseif ($requestRessource == 'update_surname'){
        if (isset($_PUT["id_user"], $_PUT["surname_user"])){
            User::updateSurname($_PUT["id_user"], $_PUT["surname_user"]);
        }

    }elseif ($requestRessource == 'update_email'){
        if (isset($_PUT["id_user"], $_PUT["email_user"])){
            $email = strval($_PUT["email_user"]);
            User::updateEmail($_PUT["id_user"], $email);
        }

    }elseif ($requestRessource == 'update_birthdate'){
        if (isset($_PUT["id_user"], $_PUT["birthdate_user"])){
            User::updateBirthdate($_PUT["id_user"], $_PUT["birthdate_user"]);
        }
    }
    header('HTTP/1.1 200 OK');
    exit();
}


function delete($db, $requestRessource, $request){ //delete tweet
    //dbDeleteTweet($db, array_shift($request), $_GET["login"]);
    if ($requestRessource == 'delete_playlist'){
        $id_playlist = array_shift($request);
        Playlist::delete($id_playlist);
    }elseif ($requestRessource == 'delete_song_from_playlist'){
        $id_playlist = array_shift($request);
        $id_song = array_shift($request);

        Playlist::deleteSongFromPlaylist($id_playlist, $id_song);
        echo json_encode($id_playlist, $id_song);
    }

    header('HTTP/1.1 200 OK');
    exit();
}

?>