<?php
require_once "../../DB.php";
/**
 * Class Song
 */
class Song
{
    /**
     * Fonction qui retourne le titre d'une chanson
     * @param $id_song
     * @return mixed
     */
    static function getTitle($id_song){
        $db = DB::connexion();

        $request = 'SELECT title_song 
                    FROM song 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui retourne la durée d'une chanson
     * @param $id_song
     * @return mixed
     */
    static function getDuration($id_song){
        $db = DB::connexion();

        $request = 'SELECT duration_song 
                    FROM song 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui retourne le lien d'une chanson
     * @param $id_song
     * @return mixed
     */
    static function getLink($id_song){
        $db = DB::connexion();

        $request = 'SELECT link_song 
                    FROM song 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui retourne toutes les informations d'une chanson
     * @param $id_song
     * @return mixed
     */
    static function getSong($id_song){
        $db = DB::connexion();

        $request = 'SELECT * 
                    FROM song 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    /**
     * Fonction qui retourne l'id de l'album de la chanson
     * @param $id_song
     * @return mixed 
     */
    static function getIdAlbum($id_song){
        $db = DB::connexion();

        $request = 'SELECT id_album 
                    FROM song 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui retourne le nom de l'album de la chanson
     * @param $id_song
     * @return mixed
     */
    static function getNameAlbum($id_song){
        $db = DB::connexion();

        $request = 'SELECT name_album 
                    FROM song 
                    JOIN album a ON a.id_album = song.id_album 
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetch()[0];
    }
    /**
     * Fonction qui retourne toutes les informations de l'album de la chanson
     * @param $id_song
     * @return mixed
     */
    static function getAlbum($id_song){
        $db = DB::connexion();

        $request = 'SELECT a.id_album, name_album, date_album, cover_album, name_artist, style_album 
                    FROM song
                    JOIN album a on a.id_album = song.id_album
                    JOIN artist a2 on a.id_artist = a2.id_artist
                    JOIN style_album sa on a.id_style_album = sa.id_style_album
                    WHERE id_song=:id_song;';

        $statement = $db->prepare($request);

        $statement->bindParam(':id_song', $id_song);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    /**
     * Fonction qui retourne vrai si la chanson est likée par l'utilisateur, faux sinon
     * @param $id_song, $id_user
     * @return bool
     */
    static function isLikedByUser($id_song, $id_user){
        try
        {
            $db = DB::connexion();

            $request = 'SELECT count(id_song) 
                        FROM playlist_song
                        JOIN playlist p ON p.id_playlist = playlist_song.id_playlist
                        JOIN user_playlist up ON p.id_playlist = up.id_playlist
                        WHERE id_user = :id_user
                        AND id_song = :id_song
                        AND is_fav;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_user', $id_user);
            $statement->bindParam(':id_song', $id_song);

            $statement->execute();

            return $statement->fetch()[0] == 1 ;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
    }
    /**
     * Fonction qui permet de faire la recherche d'une chanson
     * @param $val, $id_user
     * @return array
     */
    static function search($val, $id_user = null){
        $db = DB::connexion();

        $val = strval($val);
        $val = '%'.$val.'%';

        $request = "SELECT id_song, title_song, duration_song, link_song, song.id_album, name_album, cover_album
                    FROM song
                    JOIN album a ON song.id_album = a.id_album
                    WHERE title_song ILIKE :val ;";

        $statement = $db->prepare($request);

        $statement->bindParam(':val', $val);

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