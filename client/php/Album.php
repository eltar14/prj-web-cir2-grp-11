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
        $request = "SELECT id_album, name_album, date_album, cover_album, album.id_artist, id_style_album, name_artist FROM album
                                                                                JOIN artist a on a.id_artist = album.id_artist
WHERE name_album ILIKE :val ;";
        $statement = $db->prepare($request);
        $statement->bindParam(':val', $val);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getAll($idAlbum){
        $db = DB::connexion();
        $idAlbum = intval($idAlbum);
        $request = 'SELECT id_album, name_album, date_album, cover_album, name_artist, style_album FROM album JOIN artist USING (id_artist) JOIN style_album USING (id_style_album) WHERE id_album = :id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $idAlbum);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    static function getAllAlbum($idArtist){
        $db = DB::connexion();
        $idArtist = intval($idArtist);
        $request = 'SELECT id_album, name_album, date_album, cover_album, name_artist, style_album FROM album JOIN artist USING (id_artist) JOIN style_album USING (id_style_album) WHERE id_artist = :id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $idArtist);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    static function getSongList($id_album, $id_user){
        $db = DB::connexion();
        $id_album = intval($id_album);
        $request = 'SELECT album.id_album, name_album, id_song, title_song, date_album, duration_song, cover_album, link_song FROM album JOIN song s on album.id_album = s.id_album WHERE album.id_album = :id_album;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_album', $id_album);
        $statement->execute();

        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);

        $arr2 = [];
        foreach ($arr as $song){
            $is_liked = Song::isLikedByUser($song['id_song'], $id_user);
            $song["is_liked"] = $is_liked;
            $arr2[] = $song;
        }

        return $arr2;
    }

}