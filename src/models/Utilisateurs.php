<?php

class Utilisateurs extends Db
{

    public static function create(array $data)
    {
        //* $data recoit un tableau avec les marqueurs associés à la valeur
        $pdo = self::getDb();
        $request = "INSERT INTO utilisateurs (nom, prenom, age, pseudo, email, mdp, role) VALUES (:nom, :prenom, :age, :pseudo, :email, :mdp, :role)";
        $response = $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();
    }

    public static function findByEmail(array $email)
    {
        $request = "SELECT * FROM utilisateurs WHERE email = :email";
        $response = self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($email));

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll()
    {
        $request="SELECT * FROM utilisateurs";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(array $id)
    {
        $request="SELECT * FROM utilisateurs WHERE id=:id";
        $response = self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public static function modifier(array $data)
    {
        $request="UPDATE utilisateurs SET nom=:nom, prenom=:prenom, email=:email, pseudo=:pseudo WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($data));

        return $response;
    }

    public static function updateMdp(array $data)
    {
        $request="UPDATE utilisateurs SET mdp=:mdp WHERE id=:id";
        $response=self::getDb()->prepare($request);
        return $response->execute($data);

    }
}