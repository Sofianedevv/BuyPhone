<?php   

class Accessoire extends Db{
    public static function ajouter(array $data)
    {
        $request = "INSERT INTO accessoire(nom, prix, description, quantity, image) VALUES (:nom , :prix, :description,  :quantity, :image)";
        //la classe Accessoire hérite de Db
        //la méthode getDb() qui retourne l'objet PDO
        //ma méthode étant protected j'y ai accès dans l'enfant (la class) et étant static j'y accède avec le self et :: puis le nom de ma méthode
        $response = self::getDb()->prepare($request);
        $response->execute($data);
        return self::getDb()->lastInsertId();
    }
    public static function modifier(array $data)
    {
        $request="UPDATE accessoire SET nom=:nom, prix=:prix, description=:description, quantity=:quantity, image=:image WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($data));

        return $response;
    }

    public static function findById(array $id)
    {
        $request="SELECT * FROM accessoire WHERE id=:id";
        $response = self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response->fetch(PDO::FETCH_ASSOC);
    }
    public static function findAll()
    {
        $request="SELECT * FROM accessoire";
        $response = self::getDb()->prepare($request);
        $response->execute();

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function supprimer(array $id)
    {
        $request="DELETE FROM accessoire WHERE id=:id";
        $response=self::getDb()->prepare($request);
        $response->execute(self::htmlspecialchars($id));

        return $response;
    }
    public static function updateQuantity(array $data)
    {
        $request = "UPDATE accessoire SET quantity=:quantity WHERE id=:id";
        $response = self::getDb()->prepare($request);
        return $response->execute(self::htmlspecialchars($data));
    }



}