<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center mt-3">Bienvenue sur BuyPhone</h1>
<div class="container my-5">
<h2 class="mt-5">Nos téléphones</h2>
<div class="my-3 row justify-content-evenly border rounded border-primary py-5">
<?php foreach($telephones as $telephone): ?>
<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header"><img src="<?= UPLOAD . $telephone['image'] ;?>" alt="" class="img-fluid"></div>
  <div class="card-body">
    <h4 class="card-title"><?= $telephone['nom'] ; ?></h4>
    <p class="card-text"><?= substr($telephone['description'], 0, 150) ; ?>...</p>
    <h5 class="card-title text-end"><?= $telephone['prix'] ; ?>€</h5>

    <?php if(isset($_SESSION['panier'][$telephone['id']]) && ($telephone['quantity'] - $_SESSION['panier'][$telephone['id']] ) == 0): ?>

      <p class="text-danger text-center">Quantité maximum dans le panier</p>

    <?php elseif($telephone['quantity'] > 0): ?>
    <form action="<?= BASE . 'panier/ajouter'  ; ?>" method="post" >
    <input type="hidden" value="<?= $telephone['id'] ; ?>" name="id">
    <input type="hidden" value="telephone" name="produit">
    <div class="input-group mb-3">
      <select class="form-control" name="quantity" id="quantity">
        <?php if(!isset($_SESSION['panier'][$telephone['id']])): ?>

          <?php for($i=1; $i<=$telephone['quantity']; $i++):  ?>
          <option value="<?= $i ; ?>"><?= $i ; ?></option>
          <?php endfor;  ?>

        <?php else:  ?>
            
            <?php for($i=1; $i<=$telephone['quantity'] - $_SESSION['panier'][$telephone['id']] ; $i++):  ?>
            <option value="<?= $i ; ?>"><?= $i ; ?></option>
            <?php endfor;  ?>

        <?php endif; ?>  
      </select>
      <button class="btn btn-outline-light" type="submit" id="button-addon2">Ajouter</button>
    </div>
    </form>


    <?php else: ?>
      <h4 class="text-danger text-center">En Rupture</h4>
    <?php endif; ?>


    <div class="text-center">
        <a href="<?= BASE . 'telephone/vue?id=' . $telephone['id'] ; ?>" class="btn btn-outline-warning">voir détail</a>
    </div>
  </div>
</div>

<?php endforeach; ?>
</div>



<h2 class="mt-5">Nos accessoires</h2>
<div class="my-3 row justify-content-evenly  border rounded border-primary py-5">
<?php foreach($accessoires as $accessoire): ?>
<div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
  <div class="card-header"><img src="<?= UPLOAD . $accessoire['image'] ;?>" alt="" class="img-fluid"></div>
  <div class="card-body">
    <h4 class="card-title"><?= $accessoire['nom'] ; ?></h4>
    <p class="card-text"><?= substr($accessoire['description'], 0, 150) ; ?>...</p>
    <h5 class="card-title text-end"><?= $accessoire['prix'] ; ?>€</h5>
    <?php if(isset($_SESSION['panier'][$telephone['id']]) && ($accessoire['quantity'] - $_SESSION['panier'][$accessoire['id']] ) == 0): ?>
      <p class="text-danger text-center">Quantité maximum dans le panier</p>

    <?php elseif($accessoire['quantity'] > 0): ?>
    <form action="<?= BASE . 'panier/ajouter'  ; ?>" method="post" >
    <input type="hidden" value="<?= $accessoire['id'] ; ?>" name="id">
    <input type="hidden" value="accessoire" name="produit">
    <div class="input-group mb-3">
      <select class="form-control" name="quantity" id="quantity">
        <?php if(!isset($_SESSION['panier'][$accessoire['id']])): ?>

          <?php for($i=1; $i<=$accessoire['quantity']; $i++):  ?>
          <option value="<?= $i ; ?>"><?= $i ; ?></option>
          <?php endfor;  ?>

        <?php else:  ?>
            
            <?php for($i=1; $i<=$accessoire['quantity'] - $_SESSION['panier'][$accessoire['id']] ; $i++):  ?>
            <option value="<?= $i ; ?>"><?= $i ; ?></option>
            <?php endfor;  ?>

        <?php endif; ?>  
      </select>
      <button class="btn btn-outline-light" type="submit" id="button-addon2">Ajouter</button>
    </div>
    </form>
    

    <?php else: ?>
      <h4 class="text-danger text-center">En Rupture</h4>
    <?php endif; ?>


    <div class="text-center">
        <a href="<?= BASE . 'accessoire/vue?id=' . $accessoire['id'] ; ?>" class="btn btn-outline-warning">voir détail</a>
    </div>
  </div>
</div>

<?php endforeach; ?>
</div>
</div>
<?php include(VIEWS . '_partials/footer.php'); ?>
