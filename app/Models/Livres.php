<?php

namespace App\Models;
use PDO;
use App\Models\Model;

    class Livres extends Model
    {
        public static function create($name_clean, $auteur_clean, $avis_clean, $note_clean)
        {
            $req = self::getDb()->prepare("INSERT INTO livres (name, auteur, avis, note, created_at, modified_at) VALUES(:name, :auteur, :avis, :note, now(), now() )");
            $req->bindValue(":name", $name_clean, PDO::PARAM_STR);
            $req->bindValue(":auteur", $auteur_clean, PDO::PARAM_STR);
            $req->bindValue(":avis", $avis_clean, PDO::PARAM_STR);
            $req->bindValue(":note", $note_clean, PDO::PARAM_STR);
            
            $req->execute();
            $req->closeCursor();
        }

        public static function all()
        {
            $req = self::getDb()->prepare("SELECT * FROM livres ORDER BY created_at DESC");
            $req->execute();
            $data = $req->fetchAll(); //quand plusieurs infos, sinon fetch simple
            return $data;
            $req->closeCursor();
        }

        public static function delete($id)
        {
            $req = self::getDb()->prepare('DELETE FROM livres WHERE id=:id');
            $req->bindValue(":id", $id, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        }

        public static function find_By_Id($id)
        {
            $id = intval($id);

            $req = self::getDb()->prepare("SELECT * FROM livres WHERE id=:id");
            $req->bindValue(":id", $id, PDO::PARAM_INT);
            $req->execute();
            $row = $req->rowCount();
            if ($row == 1) 
            {
                $data = $req->fetch();
                $req->closeCursor();
                return $data;
            }
            else
            {
                $req->closeCursor();
                return false;
            }
        }

        public static function update($name_clean, $auteur_clean, $avis_clean, $note_clean, $id)
        {
            $req = self::getDb()->prepare("UPDATE livres SET name=:name, auteur=:auteur, avis=:avis, note=:note, modified_at=now() WHERE id=:id");
            $req->bindValue(":name", $name_clean, PDO::PARAM_STR);
            $req->bindValue(":auteur", $auteur_clean, PDO::PARAM_STR);
            $req->bindValue(":avis", $avis_clean, PDO::PARAM_STR);
            $req->bindValue(":note", $note_clean, PDO::PARAM_STR);
            $req->bindValue(":id", $id, PDO::PARAM_STR);
            
            $req->execute();
            $req->closeCursor();
        }
    }