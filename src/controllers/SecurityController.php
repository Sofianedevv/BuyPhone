<?php

class SecurityController
{
    public static function inscription()
    {
        if(!empty($_POST)):
            $error = [];

            function valid_pass($candidate)
            {
                $r1 = '/[A-Z]/';  //Uppercase
                $r2 = '/[a-z]/';  //lowercase
                $r3 = '/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
                $r4 = '/[0-9]/';  //numbers
                //*pour faciliter la création lors du développement on met en commentaire nos vérification sur le mot de passe 
            //    if (preg_match_all($r1, $candidate, $o) < 1) return FALSE;

            //    if (preg_match_all($r2, $candidate, $o) < 1) return FALSE;

            //    if (preg_match_all($r3, $candidate, $o) < 1) return FALSE;

            //    if (preg_match_all($r4, $candidate, $o) < 1) return FALSE;

               if (strlen($candidate) < 5) return FALSE;

                return TRUE;
            }




            if(empty($_POST['nom']) || preg_match('#[0-9]#', $_POST['nom'])):
                $error['nom'] = 'le champs est obligatoire et doit contenir uniquement des lettres';
            endif;
            if(empty($_POST['prenom']) || preg_match('#[0-9]#', $_POST['prenom'])):
                $error['prenom'] = 'le champs est obligatoire et doit contenir uniquement des lettres';
            endif;
            if(empty($_POST['age']) || $_POST['age'] < 18 ):
                $error['age'] = 'le champs est obligatoire et vous devez avoir plus de 18ans pour vous inscrire';
            endif;
            if(empty($_POST['pseudo'])):
                $error['pseudo'] = 'le champs est obligatoire';
            endif;
            //*il va falloir vérifier qu'il y ai pas 2 utilisateur avec la meme adress mail
            if( empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)  || Utilisateurs::findByEmail(['email' => $_POST['email']]) ):
                //*ici on revérifie si un utilisateur avec la même adresse mail existe, au quel cas on lui met un message d'erreur en session.
                if(Utilisateurs::findByEmail(['email' => $_POST['email']])):
                    $_SESSION['messages']['danger'][]= 'Un compte est déjà existant à cete adresse mail, veuillez procéder à la récupération du mot de passe';
                    $error['email']= '';
                else:
                    $error['email'] = 'le champs est obligatoire et l\'adresse mail doit être valide';
                endif;
            endif;
            if(empty($_POST['mdp']) || !valid_pass($_POST['mdp']) ):
                $error['mdp'] = 'le champs est obligatoire et votre mot de passe doit contenir, majuscule, minuscule,chiffre et caractère spécial';
            endif;
            if(empty($_POST['confirmMdp']) || $_POST['mdp'] !== $_POST['confirmMdp']):
                $error['confirmMdp']= 'Le champs est obligatoire et doit concorder avec le champs mot de passe';
            endif;    

            if(empty($error)):

                $mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

                Utilisateurs::create([
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST["prenom"],
                    'age'  => $_POST['age'],
                    'pseudo' => $_POST['pseudo'],
                    'email' =>$_POST['email'],
                    'mdp' => $mdp,
                    'role' => 'ROLE_USER'
                ]);

                $_SESSION['messages']['success'][] = "Félicitation, vous êtes à présent inscrit. Connectez-vous!!";
                header("location:" . BASE);
                exit();

            endif;
            

        endif;

        include(VIEWS . 'security/inscription.php');
    }

    public static function connexion()
    {
        //* vérifie que notre formulaire a été envoyé, si il est envoyé il est non vide
        if(!empty($_POST)):
            //* dans user on stock l'utilisateur qui a le mail taper dans le formulaire
            $user = Utilisateurs::findByEmail(['email' => $_POST['email']]);
            //* on vérifie que la méthode findByEmail nous ai bien retourné un utilisateur, s'il y a pas d'utilisateuron ne rentrera pas dans le if
            if($user):
                //* ici on vérifie si le mot de passe taper correspond au mot de passe de l'utilisateur récupéré avec son adresse mail
                if(password_verify($_POST['mdp'], $user['mdp'])):
                    $_SESSION['user'] = $user;
                    $_SESSION['messages']['success'][] = "Bienvenue ". $user['pseudo'] . " !!!";
                    header("location:" . BASE);
                    exit();
                //* si le mot de passe ne corresponde pas on lui met un message d'erreur
                else:
                    $_SESSION['messages']['danger'][] = 'Erreur sur le mot de passe';

                endif;
            //* Si l'adresse mail n'existe pas dans la base de donnée
            else:
                $_SESSION['messages']['danger'][] = 'Aucun compte existant à cette adresse mail';

            endif;
        endif;    

        include(VIEWS . 'security/connexion.php');
    }

    public static function deconnexion()
    {
        // die(var_dump($_SESSION['user']));
        unset($_SESSION['user']);
        // die(var_dump($_SESSION));
        $_SESSION['messages']['info'][] = 'A bientôt !!!';
        header('location:' . BASE);
        exit();
    }


}