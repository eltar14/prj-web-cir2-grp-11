<?php
require_once "../../DB.php";
/**
 * Class Album
 */
class Album
{
    /**
     * Fonction qui permet de récupérer le nom d'un album
     * @param $id_album
     * @return mixed
     */
    static function getName($id_album){ 
        $db = DB::connexion();

        $request = 'SELECT name_album 
                    FROM album 
                    WHERE id_album=:id_album;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_album', $id_album);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui permet de récupérer la date d'un album
     * @param $id_album
     * @return mixed
     */
    static function getDate($id_album){
        $db = DB::connexion();

        $request = 'SELECT date_album 
                    FROM album 
                    WHERE id_album=:id_album;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_album', $id_album);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui permet de récupérer la cover d'un album
     */
    static function getCover($id_album){
        $db = DB::connexion();

        $request = 'SELECT cover_album 
                    FROM album 
                    WHERE id_album=:id_album;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_album', $id_album);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui permet de rechercher un album
     * @param $val
     * @return array
     */
    static function search($val){
        $db = DB::connexion();

        $val = strval($val);
        $val = '%'.$val.'%';

        $request = "SELECT id_album, name_album, date_album, cover_album, album.id_artist, id_style_album, name_artist 
                    FROM album                                                            
                    JOIN artist a ON a.id_artist = album.id_artist
                    WHERE name_album ILIKE :val ;";

        $statement = $db->prepare($request);

        $statement->bindParam(':val', $val);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Fonction qui permet de récupérer toutes les informations d'un album
     * @param $id_album
     * @return mixed
     */
    static function getAll($id_album){
        $db = DB::connexion();

        $id_album = intval($id_album);

        $request = 'SELECT id_album, name_album, date_album, cover_album, name_artist, style_album 
                    FROM album 
                    JOIN artist USING (id_artist) 
                    JOIN style_album USING (id_style_album) 
                    WHERE id_album = :id_album;';
        
        $statement = $db->prepare($request);

        $statement->bindParam(':id_album', $id_album);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    /**
     * Fonction qui permet de récupérer tous les albums d'un artiste
     * @param $id_artist
     * @return array
     */
    static function getAllAlbum($id_artist){
        $db = DB::connexion();

        $id_artist = intval($id_artist);

        $request = 'SELECT id_album, name_album, date_album, cover_album, name_artist, style_album 
                    FROM album 
                    JOIN artist USING (id_artist) 
                    JOIN style_album USING (id_style_album) 
                    WHERE id_artist = :id_artist;';
        
        $statement = $db->prepare($request);
        
        $statement->bindParam(':id_artist', $id_artist);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Fonction qui permet de récupérer toutes les musiques d'un album
     * @param $id_album, $id_user
     * @return array
     */
    static function getSongList($id_album, $id_user){
        $db = DB::connexion();

        $id_album = intval($id_album);

        $request = 'SELECT album.id_album, name_album, id_song, title_song, date_album, duration_song, cover_album, link_song 
                    FROM album 
                    JOIN song s ON album.id_album = s.id_album 
                    WHERE album.id_album = :id_album;';
        
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