<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN Bootswatch -->
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
    <!-- CDN Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Lien vers notre CSS -->
    <link rel="stylesheet" href="../public/css/style.css">
    <!-- Pour rendre le title dynamique -->
    <title><?= $title ?></title>
</head>

<body>

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= SITEBASE ?>">Mon Bon Coin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="annonces">Toutes les annonces
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="nav-item"><a href="annonceAjout" class="btn btn-secondary">Nouvel Annonce</a></li>
                        <li class="nav-item"><a href="profil" class="btn btn-secondary">Profil</a></li>
                        <li class="nav-item"><a href="deconnexion" class="btn btn-secondary">Deconnexion</a></li>
                    <?php else : ?>
                        <li class="nav-item"><a href="connexion" class="btn btn-secondary">Connexion</a></li>
                    <?php endif ?>
                    <?php if(isset($_SESSION['panier'])) : ?>
                        <li class="nav-item"><a href="panier?operation=voir" class="btn btn-secondary"> <i class="bi bi-cart"></i> <span class="small"><?= count($_SESSION['panier']) ?></span></a></li>
                    <?php endif ?>    
                </ul>

            </div>
        </div>
    </nav>
    <main>
        <!-- Titre dynamique -->
        <h1 class="m-5 text-center"><?= $title ?></h1>
        <!-- Ici nous r??cup??rons les donn??es ?? afficher -->
        <div class="container">
            <?= $content;  // Affichage des donn??es 
            ?>
        </div>

    </main>


    <footer class="text-center">Jonathan &copy; 2023</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>