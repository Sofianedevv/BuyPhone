<?php


class VerifAdmin {

    public static function verif()
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

    }




}