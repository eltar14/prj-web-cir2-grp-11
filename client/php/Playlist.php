<?php
require_once "../../DB.php";
class Playlist
{
    static function addPlaylist($id_user, $name_playlist, $cover_playlsit = null){
        try {
        $db = DB::connexion();

        $name_playlist = strval($name_playlist);
        $cover_playlist = strval($cover_playlsit);

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




}