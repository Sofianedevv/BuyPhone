<?php include(VIEWS . '_partials/header.php');

if (!isset($_SESSION['user'])){

    header('location:../');
    exit();


}

?>

<div class="card mb-3">
  <h3 class="card-header">pseudo : <?= $_SESSION['user']['pseudo']; ?></h3>
  <div class="card-body">
    <h5 class="card-title"><?= $_SESSION['user']['prenom'].' '.$_SESSION['user']['nom']; ?></h5>
  </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">Age : <?= $_SESSION['user']['age']; ?></li>
        <li class="list-group-item">Email : <?= $_SESSION['user']['email']; ?></li>
    </ul>
  <div class="card-body">
    <a href="<?=  BASE.'profil/gestionProfil'."?id=".$_SESSION['user']['id'] ; ?>" class="card-link">Modifier mes informations</a>
    <a href="<?=  BASE.'profil/updateMdp'."?id=".$_SESSION['user']['id'] ; ?>" class="card-link">Modifier mon mot de passe</a>
</div>



<?php include(VIEWS . '_partials/footer.php'); ?>