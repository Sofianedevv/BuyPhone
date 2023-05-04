<?php include(VIEWS . '_partials/header.php'); ?>

<div class="container">
<form action="" method="post" enctype="multipart/form-data">
  <fieldset>
    <div class="form-group row">
      <label for="staticPseudo" class="col-sm-2 col-form-label">Pseudo: </label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticPseudo" value="<?=$_SESSION['user']['pseudo'] ;?>">
      </div>
    <div class="form-group row">
      <label for="staticPhone" class="col-sm-2 col-form-label">Modèle de téléphone: </label>
      <div class="col-sm-10">
        <input type="text" readonly="" class="form-control-plaintext" id="staticPhone" value="<?=$telephone['nom'];?>">
    </div>
    <div class="form-group">
      <label for="notes" class="form-label mt-4">Note : </label>
      <select class="form-select" id="notes" name="notes">
        <option value="1">1/5</option>
        <option value="2">2/5</option>
        <option value="3">3/5</option>
        <option value="4">4/5</option>
        <option value="5">5/5</option>
      </select>
    </div>
    <div class="form-group">
      <label for="commentaire" class="form-label mt-4">Commentaire</label>
      <textarea class="form-control" id="commentaire" name="commentaire"><?= $telephone['commentaire'] ?? "" ; ?></textarea>
      <small class="text-danger"><?= $commentaire ?? ''  ; ?></small>
    </div>
    <button type="submit" class="btn btn-primary mt-5">Publier</button>
  </fieldset>
</form>
</div>





<?php include(VIEWS . '_partials/footer.php'); ?>