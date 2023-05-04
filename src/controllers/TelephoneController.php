<?php

class TelephoneController
{
    public static function ajouter()
    {
        //*on vérifie que l'utilisateur n'est pas connecté ou qu'il est connecté mais n'est pas le role admin
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'ROLE_ADMIN' )
        {
            //* on lui refuse l'accès à la page
            // $_SESSION['messages']['danger'][] = 'Accès refusé';
            //* on le redirige vers la page d'accueil
            header('location:' . BASE);
            exit();

            
        }


        if(!empty($_POST))
        {
            $error = true;

            if(empty($_POST['nom']))
            {
                $error = false;
                $nom = "* ce champs est obligatoire";
            }
            if(empty($_POST['prix']))
            {
                $error = false;
                $prix = "* ce champs est obligatoire";
            }
            if(empty($_POST['description']))
            {
                $error = false;
                $description = "* ce champs est obligatoire";
            }
            if(empty($_POST['quantity']))
            {
                $error = false;
                $quantity = "* ce champs est obligatoire";
            }
            if(empty($_FILES['image']['name']))
            {
                $error = false;
                $image = "* ce champs est obligatoire";
            }



            // print_r($_POST);
            // print_r($_FILES);

            if($error){
                //ici on enverra le formulaire
                if( ($_FILES['image']['type'] == 'image/jpeg' || $_FILES['image']['type'] == 'image/png' || $_FILES['image']['type'] == 'image/webp') && $_FILES['image']['size'] < 3000000 ){ 

                    $nomImage = date('dmYHis') . $_FILES['image']['name'];

                    //ici on copy le fichier stocké temporairement (tmp) ($_FILES['image']['tmp_name']  image faisant référence au name de l'input type file)
                    //le deuxième paramètre est l'endroit où le fichier doit être copier avec son nouveau nom (en une seul chaine de caractère ici sa donnerai : 
                    // MVC/public/upload/dateAInstantTNomDuFichier.typeDuFichier)
                    copy($_FILES['image']['tmp_name'],PUBLIC_FOLDER . "/upload/" . $nomImage );
                    //ici on créer notre tableau de donné par rapport a notre futur requete SQL (compter le nombre de marqueur de la requête, il doit être identique au nombre de donné de votre tableau)(indice du tableau = marqueur de la requete = ligne de votre table mysql)
                    $data = [
                        'nom' => $_POST['nom'],
                        'prix' => $_POST['prix'],
                        'stockage' => $_POST['stockage'],
                        'description' => $_POST['description'],
                        'quantity' => $_POST['quantity'],
                        'image' => $nomImage
                    ];
                    //on veut accèder à la méthode ajouter de la class Telephone pour pouvoir envoyer nos données au serveur. pour cela, vue que la méthode est static, je peux l'appeler en faisant : NomDeLaClass::NomDeLaMethode($parametre);
                    Telephone::ajouter($data);




                    $_SESSION['messages']['success'][]= 'Votre téléphone a bien été ajouté';
                    header('location:'. BASE);
                    exit();


                }

            }
        }

        include(VIEWS . 'telephone/ajouter.php');
    }




    public static function gestionTelephone()
    {
        //* ici on fait le même traitemant que pour ajouter, on vérifie si l'utilisateur est connecté et sil est admin
        //* le code est juste encapsulé dans la méthode verif de la classe VerifAdmin stocké dans le dossié service
        VerifAdmin::verif();


        $telephones = Telephone::findAll();
        include(VIEWS . 'telephone/gestionTelephone.php');
    }

    public static function vueTelephone()
    {
        if(isset($_GET['id'])){
            $telephone = Telephone::findById(["id" => $_GET['id']]);
        }
        
        include(VIEWS . 'telephone/vue.php');
    }

    public static function supprimerTelephone()
    {
        VerifAdmin::verif();

        if(isset($_GET['id'])){
            if(!empty($_GET['id']))
            {
                $telephone=Telephone::findById(['id' => $_GET['id']]);
                unlink(PUBLIC_FOLDER . 'upload/' . $telephone['image']);
                Telephone::supprimer(['id' => $_GET['id']]);

                $_SESSION['messages']['success'][]= 'Votre téléphone a bien été supprimé';
                header('location:' . BASE . 'telephone/gestion');
                exit();
            }
        }
    }

    public static function modifier()
    {
        VerifAdmin::verif();

        if(isset($_GET['id']))
        {
            $telephone = Telephone::findById(['id' => $_GET['id']]);

        }
        if(!empty($_POST))
        {

            $error = true;

            if(empty($_POST['nom']))
            {
                $error = false;
                $nom = "* ce champs est obligatoire";
            }
            if(empty($_POST['prix']))
            {
                $error = false;
                $prix = "* ce champs est obligatoire";
            }
            if(empty($_POST['description']))
            {
                $error = false;
                $description = "* ce champs est obligatoire";
            }
            if(empty($_POST['quantity']))
            {
                $error = false;
                $quantity = "* ce champs est obligatoire";
            }
            if($error)
            {
                if(!empty($_FILES['image_edit']['name']) && ( ($_FILES['image_edit']['type'] == 'image/jpeg' || $_FILES['image_edit']['type'] == 'image/png' || $_FILES['image_edit']['type'] == 'image/webp') && $_FILES['image_edit']['size'] < 3000000 ))
                {
                    $nomImage = date('dmYHis') . $_FILES['image_edit']['name'];

                    unlink(PUBLIC_FOLDER . 'upload/' . $_POST['image']);

                    copy($_FILES['image_edit']['tmp_name'], PUBLIC_FOLDER . 'upload/' . $nomImage);

                }else{

                    $nomImage = $_POST['image'];

                }
                Telephone::modifier([
                    'nom' => $_POST['nom'],
                    'prix' => $_POST['prix'],
                    'description' => $_POST['description'],
                    'stockage' => $_POST['stockage'],
                    'quantity' => $_POST['quantity'],
                    'image' => $nomImage,
                    'id' => $_POST['id'],
                ]);

                // echo "update";
                $_SESSION['messages']['success'][]= 'Votre téléphone a bien été modifié';
                header('location:'. BASE . 'telephone/gestion');
                exit();


            }


        }
        
            
        include(VIEWS . 'telephone/modifier.php');
    }




}