<?php
require_once "../../DB.php";

class Album
{
    static function getName($idAlbum){
        $db = DB::connexion();
        $request = 'SELECT name_album FROM album WHERE id_album=:id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $idAlbum);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getDate($idAlbum){
        $db = DB::connexion();
        $request = 'SELECT date_album FROM album WHERE id_album=:id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $idAlbum);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getCover($idAlbum){
        $db = DB::connexion();
        $request = 'SELECT cover_album FROM album WHERE id_album=:id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $idAlbum);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function 
}