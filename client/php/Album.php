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
 


    static function search($val){

        $db = DB::connexion();
        $val = strval($val);
        $val = '%'.$val.'%';
        $request = "SELECT id_album, name_album, date_album, cover_album, id_artist, id_style_album FROM album WHERE name_album ILIKE :val ;";
        $statement = $db->prepare($request);
        $statement->bindParam(':val', $val);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    static function getAll($idAlbum){
        $db = DB::connexion();
        $idAlbum = intval($idAlbum);
        $request = 'SELECT name_album, date_album, cover_album, name_artist, style_album FROM album JOIN artist USING (id_artist) JOIN type_artist USING (id_style_album) WHERE id_album = :id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $idAlbum);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}