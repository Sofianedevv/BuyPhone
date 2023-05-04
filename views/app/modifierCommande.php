
<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center">Modifier le statut de la commande</h1>

<form action="" method="post" enctype="multipart/form-data">
  <fieldset>
    <input type="hidden" name="id" value="<?= $commande['id'] ?? "" ; ?>">
    <input type="hidden" name="id_utilisateur" value="<?= $commande['id_utilisateur'] ?? "" ; ?>">
    <div class="form-group">
      <label for="statut" class="form-label mt-4">Statut</label>
      <select name="statut" id="statut">
        <option value="En cour de traitement" <?= $commande['statut'] == "En cour de traitement" ? "selected" : "" ; ?> >En cour de traitement</option>
        <option value="Envoyé" <?= $commande['statut'] == "Envoyé" ? "selected" : "" ; ?>>Envoyé</option>
        <option value="Reçu" <?= $commande['statut'] == "Reçu" ? "selected" : "" ; ?>>Reçu</option>
      </select>
    </div>
    <input type="submit" class="btn btn-primary" value="Modifier Statut">
  </fieldset>
</form>



<?php include(VIEWS . '_partials/footer.php'); ?>