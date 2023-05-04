<?php include(VIEWS . '_partials/header.php'); ?>

<div class="container">

<?php if(isset($_SESSION['panier']) ):  ?>
<?php
    //  echo '<pre>';
    // print_r($_SESSION['panier']);
    // echo '</pre>';

?>
<div class="row d-flex align-items-center">
    <?php foreach($detailPanier as $detailProduit) : ?>
        <?php if(isset($detailProduit['telephone'])): ?>
        <div class="col-md-7">
            <img src="<?= UPLOAD . $detailProduit['telephone']['image'] ; ?>" alt="" width=100>
            <h2><?= $detailProduit['telephone']['nom'] ; ?></h2>
        </div>
        <div class="col-md-3 text-center">
            <a href="<?= BASE . 'panier/retirer?id=' . $detailProduit['telephone']['id'] . '&produit=telephone' ; ?>" class="text-decoration-none">-</a>
            <?= $detailProduit['quantity'] ; ?>
            <a href="<?= BASE . 'panier/ajouter?id=' . $detailProduit['telephone']['id'] . '&produit=telephone' ; ?>" class="text-decoration-none">+</a>
        </div>
        <div class="col-md-1 text-end">
            <?= $detailProduit     ['total'] ; ?>€
        </div>
        <div class="col-md-1 text-end">
            <a href="<?= BASE . "panier/supprimer?id=" . $detailProduit['telephone']['id'] . '&produit=telephone' ; ?>" class="text-danger">
                <i class="fad fa-times-square"></i>
            </a>
        </div>
        <?php elseif(isset($detailProduit['accessoire'])): ?>
            <div class="col-md-7">
            <img src="<?= UPLOAD . $detailProduit['accessoire']['image'] ; ?>" alt="" width=100>
            <h2><?= $detailProduit['accessoire']['nom'] ; ?></h2>
        </div>
        <div class="col-md-3 text-center">
            <a href="<?= BASE . 'panier/retirer?id=' . $detailProduit['accessoire']['id'] . '&produit=accessoire'  ; ?>" class="text-decoration-none">-</a>
            <?= $detailProduit['quantity'] ; ?>
            <a href="<?= BASE . 'panier/ajouter?id=' . $detailProduit['accessoire']['id'] . '&produit=accessoire' ; ?>" class="text-decoration-none">+</a>
        </div>
        <div class="col-md-1 text-end">
            <?= $detailProduit     ['total'] ; ?>€
        </div>
        <div class="col-md-1 text-end">
            <a href="<?= BASE . "panier/supprimer?id=" . $detailProduit['accessoire']['id'] . '&produit=accessoire' ; ?>" class="text-danger">
                <i class="fad fa-times-square"></i>
            </a>
        </div>

        <?php endif; ?>
    <?php endforeach;  ?>
    </div>
    <div class="text-end">
        <h2>Total : <?= $total ; ?>€</h2>
        <a href="<?= BASE . "panier/supprimer/all" ; ?>" class="btn btn-outline-danger">Vider Panier</a>
        <a href="<?= BASE . "commande/finaliser"; ?>" class="btn btn-primary">Finaliser la commande</a>
    </div>

<?php else :  ?>

    <h1 class="text-center">Votre panier est vide</h1>

 <?php endif;  ?>
    






</div>




<?php include(VIEWS . '_partials/footer.php'); ?>