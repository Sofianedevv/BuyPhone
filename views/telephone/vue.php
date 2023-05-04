<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center"><?= $telephone['nom'] ; ?></h1>
<div class="container">
    <div class="text-center">
    <img src="<?= UPLOAD . $telephone['image'] ; ?>" alt="" class="img-fluid"></div>
    <h2 class="px-5">Description : </h2>
    <p class="px-5 py-3"><?= $telephone['description'] ; ?></p>
    <h2 class="px-5">Caractéristique : </h2>
    <p class="px-5 py-3"><?= $telephone['stockage'] ; ?></p>
    <div class="text-end px-5">
        <?php if($telephone['quantity']> 0):  ?>
            <p class="text-success">En stock</p>
        <?php else:  ?>
            <p class="text-danger">En rupture</p>
        <?php endif;  ?>
            <h3 class="text-info"><?= $telephone['prix'] ; ?>€</h3>



    </div>
    <a href="<?=BASE. 'telephone/avis?id='.$telephone['id'] ;?>" class="btn btn-primary mt-5">Mettre un Avis</a>
        <a href="<?=BASE. 'telephone/avisClients?id='.$telephone['id'] ;?>" class="btn btn-outline-primary mt-5">Regardez les avis</a>


</div>

<?php include(VIEWS . '_partials/footer.php'); ?>