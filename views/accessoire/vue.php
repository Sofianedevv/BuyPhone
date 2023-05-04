<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center"><?= $accessoire['nom'] ; ?></h1>
<div class="container">
    <div class="text-center">
    <img src="<?= UPLOAD . $accessoire['image'] ; ?>" alt="" class="img-fluid"></div>
    <h2 class="px-5">Description : </h2>
    <p class="px-5 py-3"><?= $accessoire['description'] ; ?></p>
    <div class="text-end px-5">
        <?php if($accessoire['quantity']> 0):  ?>
            <p class="text-success">En stock</p>
        <?php else:  ?>
            <p class="text-danger">En rupture</p>
        <?php endif;  ?>
            <h3 class="text-info"><?= $accessoire['prix'] ; ?>€</h3>



    </div>



</div>

<?php include(VIEWS . '_partials/footer.php'); ?>