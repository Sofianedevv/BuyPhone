<?php

class Telephone extends Db
{
    public static function ajouter(array $data)
    {
        $pdo = self::getDb();
        $request = "INSERT INTO telephone(nom, prix, stockage, description, quantity, image) VALUES (:nom , :prix, :stockage, :description,  :quantity, :image)";
        //la classe Telephone hérite de Db
        //la méthode getDb() qui retourne l'objet PDO
        //ma méthode étant protected j'y ai accès dans l'enfant (la class) et étant static j'y accède avec le self et :: puis le nom de ma méthode
        $response = $pdo->prepare($request);
        $response->execute(self::htmlspecialchars($data));
        return $pdo->lastInsertId();
    }

    public static function findAll()
    {
        $request="SELECT * FROM telephone";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(array $id)
    {
        $request="SELECT * FROM telephone WHERE id=:id";
        $response = self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    public static function supprimer(array $id)
    {
        $request="DELETE FROM telephone WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response;
    }

    // créer une méthode appelé modifier(array $data)

    // UPDATE laTable SET index1=:valeur1, index2=:valeur2, ..... WHERE 
    public static function modifier(array $data)
    {
        $request="UPDATE telephone SET nom=:nom, prix=:prix, description=:description, stockage=:stockage, quantity=:quantity, image=:image WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($data));

        return $response;
    }

    public static function updateQuantity(array $data)
    {
        $request = "UPDATE telephone SET quantity=:quantity WHERE id=:id";
        $response = self::getDb()->prepare($request);
        return $response->execute(self::htmlspecialchars($data));
    }

}