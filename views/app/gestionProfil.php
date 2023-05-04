<?php include(VIEWS . '_partials/header.php'); ?>


<form method="post" action="<?php  echo  BASE.'profil/update' ; ?>"  enctype="multipart/form-data" >
    <fieldset>
        <div class="form-group">
            <label for="pseudo" class="form-label mt-4">Votre pseudo</label>
            <input name="pseudo"   value="<?=  $utilisateur['pseudo'] ?? '' ; ?>"  type="text" class="form-control" id="pseudo">
        </div>
        <div class="form-group">
            <label for="nom" class="form-label mt-4">Votre Nom</label>
            <input name="nom"   value="<?=  $utilisateur['nom'] ?? '' ; ?>"  type="text" class="form-control" id="nom">
        </div>
        <div class="form-group">
            <label for="prenom" class="form-label mt-4">Votre Prenom</label>
            <input name="prenom"   value="<?=  $utilisateur['prenom'] ?? '' ; ?>"  type="text" class="form-control" id="prenom" >
        </div>
        <div class="form-group">
            <label for="email" class="form-label mt-4">Votre email</label>
            <input name="email" value="<?=  $utilisateur['email'] ?? '' ; ?>" type="text" class="form-control" id="email" placeholder="Entrez votre prix">
        </div>

        <button type="submit" class="btn btn-primary mt-5 mb-5">Modifier</button>
    </fieldset>
</form>





<?php include(VIEWS . '_partials/footer.php'); ?>