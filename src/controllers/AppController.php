<?php

class AppController
{

    public static function index()
    {
        //ici je stocke dans $telephones le retour de la méhtode findAll() de la class Telephone
        $telephones = Telephone::findAll();
        $accessoires = Accessoire::findAll();
        include(VIEWS . 'app/index.php');
    }

    public static function afficherPanier()
    {

        $detailPanier = Panier::getDetailPanier();
        $total = Panier::getTotal();

        include(VIEWS . 'app/panier.php');
    }

    public static function ajoutPanier()
    {
       
        if(!empty($_POST)):
           
            
            Panier::add($_POST['id'], $_POST['produit'], $_POST['quantity'] );
            
            
        endif;

        if(!empty($_GET)):
            Panier::add($_GET['id'], $_GET['produit']);
            header('location:' . BASE. 'panier/afficher');
            exit();
        endif;
        // die(var_dump($_SESSION));
        header('location:' . BASE);
        exit();



    }
    public static function retirerPanier()
    {
        if(!empty($_GET['id']) && !empty($_GET['produit']))
        {
            Panier::remove($_GET['id'], $_GET['produit'] );
            header('location:' . BASE. 'panier/afficher');
            exit();
        }
    }

    public static function supprimerDuPanier()
    {
        if(!empty($_GET['id']) && !empty($_GET['produit']))
        {
            Panier::delete($_GET['id'], $_GET['produit']);
            header('location:' . BASE . 'panier/afficher');
            exit();
        }
    }

    public static function supprimerPanier()
    {
        Panier::destroy();
        header("location:" . BASE);
        exit();
    }

    public static function finaliserCommande()
    {
        $detailPanier = Panier::getDetailPanier();
        $total = Panier::getTotal();

        include(VIEWS . 'app/finaliserCommande.php');
    }

    public static function commander()
    {
        //* ici on stock notre panier (id_telephone => quantity)
        $panier = $_SESSION['panier'];
        //*ici on créé notre commande et on stock l'id de notre commande
        $id_commande= Commande::ajouter([
            'id_utilisateur' => $_SESSION['user']['id'],
            'date' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'statut' => "en cour de traitement"
        ]);
        //* ici on parcourt notre tableau "panier" avec comme indice = $id_telephone et comme valeur = $quantity
        foreach($panier as $nomProduit => $produit):
            foreach($produit as $id => $quantity):
                switch($nomProduit){
                    case 'telephone':
                        //*ici on ajoute en BDD notre achat grâce a l'id, l'id_commande et sa quantity
                        Achat::ajouterTelephone([
                            'id_telephone' => $id,
                            'id_commande' => $id_commande,
                            'quantity' => $quantity
                        ]);
                        //* on récupère notre telephone qui doit être modifier (au niveau de sa quantité)
                        $telephone = Telephone::findById(['id'=>$id]);
                        //* on définie une nouvelle variable qui contiendra notre nouvelle quantité du telephone ( (la quantité actuel = $telephone['quantity']) - (la quantité acheté = $quantity) )
                        $newQuantity = $telephone['quantity'] - $quantity;

                        Telephone::updateQuantity([
                            'quantity' => $newQuantity,
                            'id' => $id
                        ]);
                    break;
                    case 'accessoire':
                        //*ici on ajoute en BDD notre achat grâce a l'id, l'id_commande et sa quantity
                        Achat::ajouterAccessoire([
                            'id_accessoire' => $id,
                            'id_commande' => $id_commande,
                            'quantity' => $quantity
                        ]);
                        //* on récupère notre telephone qui doit être modifier (au niveau de sa quantité)
                        $accessoire = Accessoire::findById(['id'=>$id]);
                        //* on définie une nouvelle variable qui contiendra notre nouvelle quantité du telephone ( (la quantité actuel = $telephone['quantity']) - (la quantité acheté = $quantity) )
                        $newQuantity = $accessoire['quantity'] - $quantity;

                        Accessoire::updateQuantity([
                            'quantity' => $newQuantity,
                            'id' => $id
                        ]);
                    break;
                }
                
            endforeach;
        endforeach;

        unset($_SESSION['panier']);

        $_SESSION['messages']['success'][] = "Merci pour votre achat !!!";

        header('location:' . BASE);
        exit();




    }

    public static function gestionCommande()
    {
        VerifAdmin::verif();
        $commandes = Commande::findAll();

        include(VIEWS . 'app/gestionCommande.php');
    }
    
    public static function modifierCommande()
    {
        VerifAdmin::verif();
        // on vérifie que dans l'url il y a bien le paramètre id (et sa valeur)
        if(isset($_GET['id']))
        {
            //on déclare une variable qui va contenir la commande qu'on veut modifier.
            //on utilise la méthode findById() qui appartient à la classe Commande
            //le paramètre attendu par la méthode findById est un tableau d'indice le nom du marqueur(:id ici donc 'id') et de valeur l'id de notre commande ici récupéré grâce à la méthode GET 
            $commande = Commande::findById(['id' => $_GET['id']]);
        }
        if(!empty($_POST)){
            Commande::modifier([
                "id" => $_POST['id'],
                "id_utilisateur" => $_POST['id_utilisateur'],
                "date" => date_format(new DateTime(), 'Y-m-d H:i:s'),
                "statut" => $_POST['statut']
            ]);
            $_SESSION['messages']['success'][] = "modification du statut de la commande d'id $_POST[id]";
            header("location:" . BASE . 'commande/gestion');
            exit();


        }

        include(VIEWS . 'app/modifierCommande.php');
    }

    
    public static function ajouterAvis()
    {
        if(isset($_GET['id']))
        {
            $telephone = Telephone::findById(['id' => $_GET['id']]);
            if(!empty($_POST))
            {
                if(isset($_SESSION['user']))
                { Avis::ajouterAvis([
                        "id_telephone" =>$telephone['id'],
                        "id_utilisateur" => $_SESSION['user']['id'],
                        "commentaire" => $_POST['commentaire'],
                        "notes" => $_POST['notes'],
                        "date" => date_format(new DateTime(), 'Y-m-d H:i:s')
                       ]);
                    header('location:' . BASE);
                    exit();  
                };
            }
        }

        include(VIEWS.'telephone/avis.php');
    }


    public static function afficherAvis()
    {
        if(isset($_GET['id']))
        {
            $avis = Avis::telephoneAvis(['id_telephone' => $_GET['id']]);
            $utilisateurs = Utilisateurs::findAll();
        }
        include(VIEWS. 'app/afficherAvis.php');
    }

    public static function profil()
    {
        if (!empty($_GET['id'])):

            $utilisateur = Utilisateurs::findById([
                'id' => $_GET['id']
            ]);
        endif;
        include(VIEWS . 'app/profil.php');
    }

    public static function gestionProfil()
    {

        VerifAdmin::verif();

        if (!empty($_GET['id'])):

            $utilisateur = Utilisateurs::findById([
                'id' => $_GET['id']
            ]);
        endif;
        include(VIEWS . 'app/gestionProfil.php');
    }

    public static function updateProfil()
    {
        VerifAdmin::verif();

        if (empty($_POST['nom']) || preg_match('#[0-9]#', $_POST['nom'])):
            $error['nom'] = 'Le champs est obligatoire et doit contenir uniquement des lettres';
        endif;
        if (empty($_POST['prenom']) || preg_match('#[0-9]#', $_POST['prenom'])):
            $error['prenom'] = 'Le champs est obligatoire et doit contenir uniquement des lettres';
        endif;
        if (empty($_POST['pseudo'])):
            $error['pseudo'] = 'Le champs est obligatoire';
        endif;
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || $_POST['email'] !== $_SESSION['user']['email']):

            if (Utilisateurs::findByEmail(['email' => $_POST['email']])):
                $_SESSION['messages']['danger'][] = 'Un compte est déjà existant à cette adresse mail, veuillez procéder à la récupération de mot passe';
                $error['email'] = '';
            else:
                $error['email'] = 'Le champs est obligatoire et l\'adresse mail doit être valide';
            endif;

        endif;
       
        if (empty($error)):


            Utilisateurs::modifier([
                
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'pseudo' => $_POST['pseudo'],
                'id' => $_SESSION['user']['id'],

            ]);

            $user = Utilisateurs::findById(['id' => $_SESSION['user']['id']]);
            $_SESSION['user'] = $user;
            $_SESSION['messages']['success'][] = 'Félicitation, vous avez modifié votre profil !!';
            header('location:' . BASE .'profil?id=' . $user['id']);
            exit();

        endif;


        include(VIEWS . 'app/profil.php');
    }
    public static function updateMdp()
    {

        VerifAdmin::verif();

        $error = [];
        if (!empty($_POST)):

            function valid_pass($candidate)
            {
                $r1 = '/[A-Z]/';  //Uppercase
                $r2 = '/[a-z]/';  //lowercase
                $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
                $r4 = '/[0-9]/';  //numbers

//                if (preg_match_all($r1, $candidate, $o) < 1) return FALSE;
//
//                if (preg_match_all($r2, $candidate, $o) < 1) return FALSE;
//
//                if (preg_match_all($r3, $candidate, $o) < 1) return FALSE;
//
//                if (preg_match_all($r4, $candidate, $o) < 1) return FALSE;
//
//                if (strlen($candidate) < 8) return FALSE;

                return TRUE;
            }

            if (empty($_POST['mdp']) || !valid_pass($_POST['mdp'])):
                $error['mdp'] = 'Le champs est obligatoire et votre mot de passe doit contenir, majuscule, minuscule, chiffre lettre et caractère spécial';
            endif;
            if (empty($_POST['confirmMdp']) || $_POST['mdp'] !== $_POST['confirmMdp']):
                $error['confirmMdp'] = 'Le champs est obligatoire et doit concorder avec le champs mot de passe';
            endif;
            if (empty($_POST['actualMdp']) || !password_verify($_POST['actualMdp'], $_SESSION['user']['mdp'])):
                $error['actualMdp'] = 'Le mot de passe actuel est incorrect';
            endif;

            if (empty($error)):
                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

                Utilisateurs::updateMdp([
                    'mdp' => $mdp,
                    'id' => $_SESSION['user']['id'],
                ]);

                $user = Utilisateurs::findById(['id' => $_SESSION['user']['id']]);
                $_SESSION['user'] = $user;
                $_SESSION['messages']['success'][] = 'Félicitation, Mot de passe modifié !!';
                header('location:' . BASE .'profil?id=' . $user['id']);
                exit();

            endif;


        endif;
        include(VIEWS . 'app/modificationMdp.php');
    }
}
