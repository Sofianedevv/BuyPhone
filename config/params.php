<?php

/**
 * Fichier contenant la configuration de l'application
 */
const CONFIG = [
    'db' => [
        'DB_HOST' => 'localhost',
        'DB_PORT' => '3306',
        'DB_NAME' => 'phone',
        'DB_USER' => 'root',
        'DB_PSWD' => '',
    ],
    'app' => [
        'name' => 'Mon Projet',
        'projectBaseUrl' => 'http://localhost/buyphone'
    ]
];

/**
 * Constantes pour accéder rapidement aux dossiers importants du MVC
 */
const BASE_DIR = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR  ;
// constantes à appeler dans l'html
const BASE= CONFIG['app']['projectBaseUrl'] . '/public/index.php/';
const UPLOAD = CONFIG['app']['projectBaseUrl'] . '/public/upload/';
// constantes à appeler dans le php
const PUBLIC_FOLDER = BASE_DIR . 'public\\';
const VIEWS = BASE_DIR . 'views/';
const MODELS = BASE_DIR . 'src/models/';
const CONTROLLERS = BASE_DIR . 'src/controllers/';


/**
 * Liste des actions/méthodes possibles (les routes du routeur)
 */
$routes = [
    ''                  => ['AppController', 'index'],
    '/'                 => ['AppController', 'index'],
    '/telephone/ajouter' => ['TelephoneController', 'ajouter'],
    '/telephone/gestion' => ['TelephoneController', 'gestionTelephone'],
    '/telephone/vue'    => ['TelephoneController', 'vueTelephone'],
    '/telephone/supprimer' => ['TelephoneController', 'supprimerTelephone'],
    '/telephone/modifier' => ['TelephoneController', 'modifier'],
    '/panier/ajouter'  => ['AppController', 'ajoutPanier'],
    '/panier/afficher' => ['AppController', 'afficherPanier'],
    '/panier/retirer' => ['AppController', 'retirerPanier'],
    '/panier/supprimer' => ['AppController', 'supprimerDuPanier'],
    '/panier/supprimer/all' => ['AppController', 'supprimerPanier'],
    '/inscription'   => ['SecurityController', 'inscription'],
    '/connexion'   => ['SecurityController', 'connexion'],
    '/deconnexion' => ['SecurityController', 'deconnexion'],
    '/commande/finaliser' => ['AppController', 'finaliserCommande'],
    '/commande/finaliser/valider' => ['AppController', 'commander'],
    '/commande/gestion'  => ['AppController', 'gestionCommande'],
    '/commande/modifier' => ['AppController', 'modifierCommande'],
    '/accessoire/modifier'=>['AccessoireController','modifier'],
    '/accessoire/gestion'=>['AccessoireController','gestionAccessoire'],
    '/accessoire/ajouter'=>['AccessoireController','ajouter'],
    '/accessoire/supprimer'=>['AccessoireController','supprimer'],
    '/accessoire/vue'=>['AccessoireController','vueAccessoire'],
    '/telephone/avis' => ['AppController', 'ajouterAvis'],
    '/telephone/avisClients' => ['AppController', 'afficherAvis'],
    '/profil'=>  ['AppController', 'profil'],
    '/profil/gestionProfil'=>  ['AppController', 'gestionProfil'],
    '/profil/update'=>  ['AppController', 'updateProfil'],
    '/profil/updateMdp'=>  ['AppController', 'updateMdp'],
    
    
    



];
