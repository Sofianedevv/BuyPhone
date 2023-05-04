<?php include(VIEWS . '_partials/header.php'); ?>
<div class="container">
<h1 class="text-center">Inscription</h1>

<form action="" method="post" enctype="multipart/form-data" class="row">
    <div class="form-group col-md-6">
      <label for="nom" class="form-label mt-4">Nom</label>
      <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?= $_POST['nom'] ?? "" ; ?>">
      <small class="text-danger"><?= $error['nom'] ?? "" ; ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="prenom" class="form-label mt-4">Prénom</label>
      <input type="text" class="form-control" id="prenom" placeholder="Prénom"   name="prenom" value="<?= $_POST['prenom'] ?? "" ; ?>">
      <small class="text-danger"><?= $error['prenom'] ?? ""; ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="age" class="form-label mt-4">Age</label>
      <input class="form-control" type="number" id="age" name="age" min="18" value="<?= $_POST['age'] ?? "" ; ?>">
      <small class="text-danger"><?= $error['age'] ?? ""; ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="pseudo" class="form-label mt-4">Pseudo</label>
      <input type="text" class="form-control" id="pseudo" placeholder="Pseudo"  name="pseudo" value="<?= $_POST['pseudo'] ?? "" ; ?>">
      <small class="text-danger"><?= $error['pseudo'] ?? ""; ?></small>
    </div>
    <div class="form-group col-md-12">
      <label for="email" class="form-label mt-4">E-mail</label>
      <input type="text" class="form-control" id="email" placeholder="dupont@mail.com"  name="email" value="<?= $_POST['email'] ?? "" ; ?>">
      <small class="text-danger"><?= $error['email'] ?? ""; ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="mdp" class="form-label mt-4">Mot de passe</label>
      <input type="password" class="form-control" id="mdp" placeholder="Mot de passe"  name="mdp">
      <small class="text-danger"><?= $error["mdp"] ?? ""; ?></small>
    </div>
    <div class="form-group col-md-6">
      <label for="confirmMdp" class="form-label mt-4">Confirmation du mot de passe</label>
      <input type="password" class="form-control" id="confirmMdp" placeholder="Confirmation du mot de passe"  name="confirmMdp">
      <small class="text-danger"><?=  $error['confirmMdp'] ?? ""; ?></small>
    </div>
    <button type="submit" class="btn btn-primary mt-5">S'inscrire</button>
</form>




</div>
<?php include(VIEWS . '_partials/footer.php'); ?>