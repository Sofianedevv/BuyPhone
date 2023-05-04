<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center">Gestion des téléphones</h1>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#id</th>
      <th scope="col">Nom</th>
      <th scope="col">Prix</th>
      <th scope="col">Description</th>
      <th scope="col">Stockage</th>
      <th scope="col">Image</th>
      <th scope="col">Quantité</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($telephones as $telephone) :  ?>
    <tr class="table-active">
      <td><?= $telephone['id'] ; ?></td>
      <td><?= $telephone['nom'] ; ?></td>
      <td><?= $telephone['prix'] ; ?>€</td>
      <td><?= substr($telephone['description'], 0, 20) ; ?></td>
      <td><?= $telephone['stockage'] ; ?></td>
      <td><img src="<?= UPLOAD . $telephone['image']  ; ?>" width="70" alt=""></td>
      <td><?= $telephone['quantity'] ; ?></td>
      <td>
        <a href="<?= BASE . 'telephone/vue?id=' . $telephone['id'] ; ?>" class="text-info"><i class="fas fa-search"></i></a>
        <a href="<?= BASE . "telephone/modifier?id=" . $telephone['id'] ; ?>" class="text-warning"><i class="fas fa-edit"></i></a>
        <a href="<?= BASE . 'telephone/supprimer?id=' . $telephone["id"] ; ?>" class="text-danger"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach;  ?>
    </tbody>
</table>
</div>


<?php include(VIEWS . '_partials/footer.php'); ?>