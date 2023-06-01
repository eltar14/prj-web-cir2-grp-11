<?php
require_once "../../DB.php";
class Song
{
    static function getName($idSong){
        $db = DB::connexion();
        $request = 'SELECT name_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $idSong);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getTitle($idSong){
        $db = DB::connexion();
        $request = 'SELECT title_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $idSong);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getDuration($idSong){
        $db = DB::connexion();
        $request = 'SELECT duration_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $idSong);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getLink($idSong){
        $db = DB::connexion();
        $request = 'SELECT link_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $idSong);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getSong($idSong){
        $db = DB::connexion();
        $request = 'SELECT * FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $idSong);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}