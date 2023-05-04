<?php include(VIEWS . '_partials/header.php'); ?>
<div class="container">
    <h1 class="text-center">Finaliser sa commande</h1>

    <div class=" mx-auto border border-primary rounded p-3 mt-4">
        <h2 class="border-bottom border-primary text-center">Détails de votre commande</h2>
        <div class="border-bottom border-primary mt-2 mx-3 row">
                <div class="col-6">Nom du produit</div>
                <div class="col-3 text-center">Quantité</div>
                <div class="col-3 text-end">Prix</div>
        </div>
        <?php foreach($detailPanier as $detailProduit): ?>

            <?php if(isset($detailProduit['telephone'])): ?>
            <div class="border-bottom border-primary mt-2 mx-3 row">
                <h3 class="col-6 h5"><?= $detailProduit['telephone']["nom"]; ?></h3>
                <div class="col-3 text-center"><?= $detailProduit['quantity']; ?></div>
                <div class="col-3 text-end"><?= $detailProduit['total']; ?>€</div>
            </div>

            <?php elseif(isset($detailProduit['accessoire'])): ?>
            <div class="border-bottom border-primary mt-2 mx-3 row">
                <h3 class="col-6 h5"><?= $detailProduit['accessoire']["nom"]; ?></h3>
                <div class="col-3 text-center"><?= $detailProduit['quantity']; ?></div>
                <div class="col-3 text-end"><?= $detailProduit['total']; ?>€</div>
            </div>

            <?php endif; ?>
        <?php endforeach; ?>
        <div class="mt-2 mx-3 row">
            <h3 class="col-6 h5">Total : </h3>
            <h3 class="col-6 h5 text-end"><?= $total; ?>€</h3>
        </div>
    </div>
    <?php if(isset($_SESSION['user'])): ?>
    <div class="text-center mt-3">
        <a href="<?= BASE . "commande/finaliser/valider"; ?>" class="btn btn-primary w-50">Commander</a>
    </div>
    <?php else: ?>
    <div class="text-center mt-3">
        <p>Pour finaliser votre commande
        <a href="<?= BASE . "connexion"; ?>" class="btn btn-primary">connectez-vous</a></p>
    </div>
    <?php endif; ?>
</div>
<?php include(VIEWS . '_partials/footer.php'); ?>