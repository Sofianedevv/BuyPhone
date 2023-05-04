<?php include(VIEWS . '_partials/header.php'); ?>

<div class="container my-5">
<h1 class="text-center">Ajouter un téléphone</h1>

<form action="" method="post" enctype="multipart/form-data">
  <fieldset>
    
    <div class="form-group">
      <label for="nom" class="form-label mt-4">Nom du téléphone</label>
      <input type="text" class="form-control" id="nom" placeholder="Nom du téléphone" name="nom" value="<?= $_POST['nom'] ?? "" ; ?>">
      <small class="text-danger"><?= $nom ?? ''  ; ?></small>
    </div>
    <div class="form-group">
      <label for="prix" class="form-label mt-4">Prix</label>
      <input type="number" class="form-control" id="prix" placeholder="Prix" min="0" step="0.01" name="prix" value="<?= $_POST['prix'] ?? "" ; ?>">
      <small class="text-danger"><?= $prix ?? ''  ; ?></small>
    </div>
    <div class="form-group">
      <label for="description" class="form-label mt-4">Description</label>
      <textarea class="form-control" id="description" name="description"><?= $_POST['description'] ?? "" ; ?></textarea>
      <small class="text-danger"><?= $description ?? ''  ; ?></small>
    </div>
    <div class="form-group">
      <label for="image" class="form-label mt-4">Image</label>
      <input class="form-control" type="file" id="image" name="image">
      <small class="text-danger"><?= $image ?? ''  ; ?></small>
    </div>
    <div class="form-group">
      <label for="stockage" class="form-label mt-4">Stockage</label>
      <select class="form-select" id="stockage" name="stockage">
        <option value="32Go">32Go</option>
        <option value="64Go">64Go</option>
        <option value="128Go">128Go</option>
        <option value="256Go">256Go</option>
        <option value="512Go">512Go</option>
      </select>
    </div>
    <div class="form-group">
      <label for="quantity" class="form-label mt-4">Quantité</label>
      <input type="number" class="form-control" id="quantity" placeholder="Quantité" min="0"  name="quantity" value="<?= $_POST['quantity'] ?? "" ; ?>">
      <small class="text-danger"><?= $quantity ?? ''  ; ?></small>
    </div>
    <button type="submit" class="btn btn-primary mt-5">Ajouter</button>
  </fieldset>
</form>



</div>

<?php include(VIEWS . '_partials/footer.php'); ?>
