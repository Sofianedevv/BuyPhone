<?php


class Commande extends Db
{

    public static function ajouter(array $data)
    {
        $pdo = self::getDb();
        $request="INSERT INTO commande (id_utilisateur, date, statut) VALUES (:id_utilisateur, :date, :statut)";
        $response= $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();

    }

    public static function findAll()
    {   
        $request = "SELECT * FROM commande";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);


    }

    public static function findById(array $id)
    {
        $request="SELECT * FROM commande WHERE id=:id";
        $response = self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifier(array $data)
    {
        $request="UPDATE commande SET id_utilisateur=:id_utilisateur, date=:date, statut=:statut WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($data));

        return $response;
    }

}