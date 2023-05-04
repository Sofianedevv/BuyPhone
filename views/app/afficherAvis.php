<?php include(VIEWS . '_partials/header.php'); ?>

<h1 class="text-center my-5">Les avis de nos clients</h1>

<div class="container">
    <?php foreach($avis as $unAvis): ?>
        <?php foreach($utilisateurs as $utilisateur):  ?>
            <?php if($unAvis['id_utilisateur'] == $utilisateur['id']): ?>
<div class="card border-light mb-3" style="max-width: 20rem;">
  <div class="card-header">Pseudo : <?=$utilisateur['pseudo'] ;?></div>
  <div class="card-body">
    <h4 class="card-title">Note : <?=$unAvis['notes'] ;?> /5 </h4>
    <p class="card-text"><?=$unAvis['commentaire'] ;?></p>
  </div>
    <?php endif; ?>
  <?php endforeach; endforeach; ?>
</div>





<?php include(VIEWS . '_partials/footer.php'); ?>