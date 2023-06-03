<?php
require_once "../../DB.php";
class Playlist
{
    static function addPlaylist($id_user, $name_playlist, $cover_playlist = ""){
        try {
        $db = DB::connexion();

        $name_playlist = strval($name_playlist);
        $cover_playlist = strval($cover_playlist);

        $request = 'INSERT INTO playlist(name_playlist, cover_playlist) values(:name_playlist, :cover_playlist)';
        $statement = $db->prepare($request);

        $statement->bindParam(':name_playlist', $name_playlist);
        $statement->bindParam(':cover_playlist', $cover_playlist);
        $statement->execute();

        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
        try {
        $id_user = intval($id_user);
        $id_playlist = $db->lastInsertId();
        echo $id_playlist;

        $request = 'INSERT INTO user_playlist(id_playlist, id_user, date_playlist) values (:id_playlist, :id_user, CURRENT_DATE);';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_playlist', $id_playlist);
        $statement->bindParam(':id_user', $id_user);
        $statement->execute();
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
    }

    static function updateName($id_playlist, $new_name){
        try {
            $db = DB::connexion();
            $id_playlist = intval($id_playlist);
            $new_name = strval($new_name);

            $request = 'UPDATE playlist SET name_playlist = :name_playlist WHERE id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':name_playlist', $new_name);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }


    static function delete($id_playlist){
        $db = DB::connexion();
        $id_playlist = intval($id_playlist);

        try {
            $request = 'DELETE FROM user_playlist WHERE id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();

        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
        try {
            $request = 'DELETE FROM playlist WHERE id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();

        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }

    }

    static function getName($id_playlist){
        $db = DB::connexion();
        $id_playlist = intval($id_playlist);

        try {
            $request = 'SELECT name_playlist FROM playlist WHERE id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result = $statement->fetch();
            return $result['name_playlist'];
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
    }

    static function getCover($id_playlist){
        $db = DB::connexion();
        $id_playlist = intval($id_playlist);

        try {
            $request = 'SELECT cover_playlist FROM playlist WHERE id_playlist = :id_playlist;';
            $statement = $db->prepare($request);
            $statement->bindParam(':id_playlist', $id_playlist);
            $statement->execute();
            $result = $statement->fetch();
            return $result['cover_playlist'];
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
    }

    static function getAllPlaylists(){
        $db = DB::connexion();

        try {
            $request = 'SELECT * FROM playlist;';
            $statement = $db->prepare($request);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
    }

    function isLiked(){
        $db = DB::connexion();

        try{
            $request = 'SELECT ';
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
        }
    }






}