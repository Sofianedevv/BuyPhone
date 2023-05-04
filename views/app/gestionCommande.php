
<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center">Gestion des commandes</h1>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#id</th>
      <th scope="col">id_utilisateur</th>
      <th scope="col">date</th>
      <th scope="col">statut</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($commandes as $commande) :  ?>
    <tr class="table-active">
      <td><?= $commande['id'] ; ?></td>
      <td><?= $commande['id_utilisateur'] ; ?></td>
      <td><?= $commande['date'] ; ?></td>
      <td><?= $commande['statut'] ; ?></td>
      <td>
        <a href="" class="text-info"><i class="fas fa-search"></i></a>
        <a href="<?= BASE . "commande/modifier?id=". $commande['id'] ; ?>" class="text-warning"><i class="fas fa-edit"></i></a>
        <a href="" class="text-danger"><i class="fas fa-trash"></i></a>
      </td>
    </tr>
    <?php endforeach;  ?>
    </tbody>
</table>
</div>

<?php include(VIEWS . '_partials/footer.php'); ?>