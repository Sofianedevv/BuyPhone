<?php

class Avis extends Db
{
    public static function ajouterAvis(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO avis (id_telephone, id_utilisateur, commentaire, notes, date) VALUES (:id_telephone, :id_utilisateur, :commentaire, :notes, :date)";
        $response= $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();
    }


    public static function findById(array $data)
    {
        $request = "SELECT * FROM avis WHERE id_utilisateur = :id_utilisateur";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function telephoneAvis(array $data)
    {
        $request = "SELECT * FROM avis WHERE id_telephone = :id_telephone";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
}