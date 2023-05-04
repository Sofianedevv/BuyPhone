<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center">Gestion des accessoires</h1>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Description</th>
                <th scope="col">Quantité</th>
                <th scope="col">Image</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($accessoires as $accessoire):  ?>
                <tr class="table-active">
                    <td><?=  $accessoire['nom']; ?></td>
                    <td><?=  $accessoire['prix']; ?></td>
                    <td><?=substr($accessoire['description'],0,20); ?></td>
                    <td><?= $accessoire['quantity'] ; ?></td>
                    <td><img src="<?= UPLOAD .$accessoire['image'] ; ?>" width="70" alt=""></td>
                    <td>
                        <a href="<?= BASE . 'accessoire/vue?id=' . $accessoire['id'] ; ?>" class="text-info"><i class="fas fa-search"></i></a>
                        <a href="<?= BASE.'accessoire/modifier?id='.$accessoire['id'] ; ?>"><i class="fas fa-edit"></i></a>
                        <a href="<?= BASE .'accessoire/supprimer?id='.$accessoire["id"] ; ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach;  ?>
        </tbody>
    </table>
</div>
<?php include(VIEWS . '_partials/footer.php'); ?>