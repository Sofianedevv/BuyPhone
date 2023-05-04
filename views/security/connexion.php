
<?php include(VIEWS . '_partials/header.php'); ?>


<!-- ici le formulaire -->
<div class="container">
    

    <form action="" method="post" class="w-50 mx-auto border border-primary rounded p-5 mt-5">
        <h1 class="text-center">Connexion</h1>
        <div class="form-group">
            <label for="email" class="form-label mt-4">E-mail</label>
            <input type="text" class="form-control" id="email" placeholder="dupont@mail.com"  name="email" value="<?= $_POST['email'] ?? "" ; ?>">
            <small class="text-danger"><?= $error['email'] ?? ""; ?></small>
        </div>
        <div class="form-group">
            <label for="mdp" class="form-label mt-4">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" placeholder="Mot de passe"  name="mdp">
            <small class="text-danger"><?= $error["mdp"] ?? ""; ?></small>
        </div>

        <button class="btn btn-info mt-4 w-100" type="submit">Se connecter</button>

    </form>



</div>
<?php include(VIEWS . '_partials/footer.php'); ?>