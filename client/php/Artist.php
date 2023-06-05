<?php
require_once "../../DB.php";
class Artist
{

    static function getName($id_artist){
        $db = DB::connexion();
        $request = 'SELECT name_artist FROM artist WHERE id_artist=:id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $id_artist);
        $statement->execute();
        return $statement->fetch()[0];
    }

    static function getType($id_artist){
        $db = DB::connexion();
        $request = 'SELECT type_artist FROM artist JOIN type_artist ta on artist.id_type_artist = ta.id_type_artist WHERE id_artist=:id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $id_artist);
        $statement->execute();
        return $statement->fetch()[0];
    }

    static function getDescription($id_artist){
        $db = DB::connexion();
        $request = 'SELECT description_artist FROM artist WHERE id_artist = :id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $id_artist);
        $statement->execute();
        return $statement->fetch()[0];
    }

    static function getAll($id_artist){
        $db = DB::connexion();
        $id_artist = intval($id_artist);
        $request = 'SELECT id_artist, name_artist, description_artist, type_artist, artist.id_type_artist FROM artist JOIN type_artist ta on artist.id_type_artist = ta.id_type_artist  WHERE id_artist = :id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $id_artist);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC)[0];
    }

    static function getAllAlbum($id_artist){
        $db = DB::connexion();
        $id_artist = intval($id_artist);
        $request = 'SELECT * FROM album JOIN artist USING (id_artist) where id_artist = :id_artist;';
        $statement = $db->prepare($request);
        $statement->bindParam(':id_artist', $id_artist);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    static function addArtist($name_artist, $description_artist, $id_type_artist){
        if(!empty($name_artist) and !empty($description_artist) and !empty($id_type_artist)){
            try {
                $db = DB::connexion();
                $name_artist = strval($name_artist);
                $description_artist = strval($description_artist);
                $id_type_artist = intval($id_type_artist);

                $request = 'INSERT INTO artist(name_artist, description_artist, id_type_artist) VALUES(:name_artist, :description_artist, :id_type_artist);';
                $statement = $db->prepare($request);
                $statement->bindParam(':name_artist', $name_artist);
                $statement->bindParam(':description_artist', $description_artist);
                $statement->bindParam(':id_type_artist', $id_type_artist);
                $statement->execute();

                return "ok";
            } catch (PDOException $exception) {
                error_log('Request error: ' . $exception->getMessage());
                return "error";
            }
        }else{
            return "error";
        }
    }


    static function search($val){

        $db = DB::connexion();
        $val = strval($val);
        $val = '%'.$val.'%';
        $request = "SELECT id_artist, name_artist, description_artist, type_artist FROM artist JOIN type_artist ta on ta.id_type_artist = artist.id_type_artist WHERE name_artist ILIKE :val;";
        $statement = $db->prepare($request);
        $statement->bindParam(':val', $val);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



}