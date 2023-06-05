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

    static function isLikedByUser($id_song, $id_user){
        try{
            $db = DB::connexion();
            $request = 'SELECT count(id_song) FROM playlist_song
                            JOIN playlist p on p.id_playlist = playlist_song.id_playlist
                            JOIN user_playlist up on p.id_playlist = up.id_playlist
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


    static function search($val, $id_user = null){

        $db = DB::connexion();
        $val = strval($val);
        $val = '%'.$val.'%';
        $request = "SELECT id_song, title_song, duration_song, link_song, song.id_album, name_album, cover_album
                    FROM song
                        JOIN album a on song.id_album = a.id_album
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

    static function addToHistory($id_user, $id_song){
        try{
            $db = DB::connexion();

            $request = 'INSERT INTO history (id_song, id_user) VALUES (:id_song, :id_user);';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_song', $id_song);
            $statement->bindParam(':id_user', $id_user);

            $statement->execute();

            return true;
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }

    }

    static function getHistory($id_user){
        try{
            $db = DB::connexion();

            $request = 'SELECT id_song, title_song, duration_song, link_song, song.id_album, name_album, cover_album
                        FROM history
                            JOIN song on history.id_song = song.id_song
                            JOIN album a on song.id_album = a.id_album
                        WHERE id_user = :id_user
                        ORDER BY date_history DESC
                        LIMIT 10;';

            $statement = $db->prepare($request);

            $statement->bindParam(':id_user', $id_user);

            $statement->execute();

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $exception)
        {
            error_log('Request error: '.$exception->getMessage());
            return false;
        }
        
    }
    


}