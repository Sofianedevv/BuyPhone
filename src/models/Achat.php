<?php

class Achat extends Db
{
    public static function ajouterTelephone(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO achat (id_telephone, id_commande, quantity) VALUES (:id_telephone, :id_commande, :quantity)";
        $response= $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();

    }
    public static function ajouterAccessoire(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO achat (id_accessoire, id_commande, quantity) VALUES (:id_accessoire, :id_commande, :quantity)";
        $response= $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();

    }

}