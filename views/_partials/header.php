<!doctype html>
<html lang="en">

<head>
    <title><?= CONFIG['app']['name'] ?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/lux/bootstrap.min.css" integrity="sha512-+TCHrZDlJaieLxYGAxpR5QgMae/jFXNkrc6sxxYsIVuo/28nknKtf9Qv+J2PqqPXj0vtZo9AKW/SMWXe8i/o6w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">


</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">BuyPhone</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="<?= BASE ; ?>">Accueil
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn me-5 position-relative bg-transparent text-secondary" href="<?= BASE . 'panier/afficher' ; ?>"><i
                            class="fas fa-shopping-basket fa-2x"></i><span
                            class="badge position-absolute top-0 start-100 translate-middle bg-danger text-secondary">
            <?php if (!isset($_SESSION['panier'])):echo 0;
            else: 
              $items = 0;
              if(isset($_SESSION['panier']['telephone'])):
              foreach($_SESSION['panier']['telephone'] as $quantite):
                $items += $quantite;
              endforeach;
            endif;
            if(isset($_SESSION['panier']['accessoire'])):
              foreach($_SESSION['panier']['accessoire'] as $quantite):
                $items += $quantite;
              endforeach;
            endif;
              echo $items;
            endif; ?></span></a>
        </li>
        <!-- ici on vérifie que l'utilisateur est connecté -->
        <?php if(isset($_SESSION['user'])): ?>
           <?php if($_SESSION['user']['role'] == 'ROLE_ADMIN'): ?>
          <li class="nav-item">
          <a class="nav-link active" href="<?= BASE . 'profil?id=' . $_SESSION['user']['id']; ?>">Mon compte
          </a>
        </li>
          <!-- ici on vérifie que l'utilisateur connecté a le role admin -->
         
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">BACK OFFICE</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="<?= BASE . "accessoire/ajouter"  ; ?>">Ajouter un accessoire</a>
            <a class="dropdown-item" href="<?= BASE . "telephone/ajouter"  ; ?>">Ajouter un téléphone</a>
            <a class="dropdown-item" href="<?= BASE . "accessoire/gestion" ; ?>">Gestion Accessoire</a>
            <a class="dropdown-item" href="<?= BASE . "telephone/gestion" ; ?>">Gestion téléphone</a>
            <a class="dropdown-item" href="<?= BASE . "commande/gestion" ; ?>">Gestion commande</a>
          </div>
        </li>
        <?php endif; endif; ?>
      </ul>
      <!-- ici on vérifie que le user est connecté si dans session on a un tableau user qui existe -->
      <?php if(isset($_SESSION['user'])): ?>
      <a href="<?= BASE . "deconnexion"; ?>" class="btn btn-outline-secondary">Deconnexion</a>
      <!-- sinon -->
      <?php else: ?>
      <a href="<?= BASE . "inscription"; ?>" class="btn btn-outline-secondary">Inscription</a>
      <a href="<?= BASE . "connexion"; ?>" class="btn btn-outline-info mx-1">Connexion</a>
      <?php endif; ?>
    </div>
  </div>
</nav>    

<div class="container mt-5">

    <?php if(isset($_SESSION['messages'])):
        foreach ($_SESSION['messages'] as $type => $messages):
          foreach($messages as $message):
    ?>
    
            <div class="w-50 text-center mx-auto alert alert-<?= $type; ?>"> <?= $message; ?> </div>
    
    
    <?php endforeach; endforeach;
    //* suppression de tout les messages sauvegardé dans la session.
    unset($_SESSION['messages']);  
  endif;
    ?>


</div>
