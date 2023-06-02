<?php
require_once "../../DB.php";
class Song
{
    static function getTitle($id_song){
        $db = DB::connexion();
        $request = 'SELECT title_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetch()[0];
    }

    /**
     * returns duration of the song in seconds
     * @param $id_song
     * @return mixed
     */
    static function getDuration($id_song){
        $db = DB::connexion();
        $request = 'SELECT duration_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getLink($id_song){
        $db = DB::connexion();
        $request = 'SELECT link_song FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getSong($id_song){
        $db = DB::connexion();
        $request = 'SELECT * FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    static function getIdAlbum($id_song){
        $db = DB::connexion();
        $request = 'SELECT id_album FROM song WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getNameAlbum($id_song){
        $db = DB::connexion();
        $request = 'SELECT name_album FROM song JOIN album a on a.id_album = song.id_album WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetch()[0];
    }

    static function getAlbum($id_song){
        $db = DB::connexion();
        $request = 'SELECT a.id_album, name_album, date_album, cover_album, name_artist, style_album FROM song
                    JOIN album a on a.id_album = song.id_album
                    JOIN artist a2 on a.id_artist = a2.id_artist
                    JOIN style_album sa on a.id_style_album = sa.id_style_album
                    WHERE id_song=:id_song;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_song', $id_song);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }


    static function search($val){

        $db = DB::connexion();
        $val = strval($val);
        $val = '%'.$val.'%';
        $request = "SELECT id_song, title_song, duration_song, link_song, song.id_album, name_album FROM song JOIN album a on song.id_album = a.id_album WHERE title_song ILIKE :val ;";
        $statement = $db->prepare($request);
        $statement->bindParam(':val', $val);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }



}