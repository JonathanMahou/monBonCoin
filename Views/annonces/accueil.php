<?php
// var_dump($annonces);
if (isset($_SESSION['messages'])){
    $message = $_SESSION['messages'];
    unset($_SESSION['messages']);

    echo '<div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Félicitation !</h4>
            <p class="bm-0">' . $message . '</p>
        </div>';
}
?>


<h2 class="mt-4"><?= $sousTitre ?></h2>
<div class="container border border-secondary p-5">

    <div class="row justify-content-around">
        <?php foreach ($annonces as $key => $annonce) : ?>
            <div class="card text-white bg-primary mb-3" style="max-width: 20rem;">
                <div class="card-header">Categorie : <?= $annonce['nameCat'] ?> </div>
                <div class="card-body">
                    <h4 class="card-title"><?= $annonce['title'] ?> : <?= $annonce['price'] ?> € </h4>
                    <img src="<?= SITEBASE ?>/img/annonces/<?= $annonce['image']?>" alt="<?= $annonce['title'] ?>" class="img-fluid">
                    <p class="card-text"><?= $annonce ['description'] ?></p>
                </div>
                <div class="card-footer text-center">
                    <a href="annonceDetail?id=<?= $annonce['idAnnonce']?>" class="btn btn-secondary">Voir le detail</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div> 