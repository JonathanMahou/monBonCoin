<?php 
if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);

    echo '<div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Félicitation !</h4>
            <p class="bm-0">' . $message . '</p>
        </div>';
}

?>

<div class="container">
    <?php if ($errMsg) : ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Attention !</h4>
            <p class="bm-0"><?= $errMsg ?></p>
        </div>
    <?php endif ?>
    <form method="POST">
        <div class="row justify-content-around">
            <div class="col-12 col-md-4">
                <label for="login">Email</label>
                <input type="text" name="login" id="login" placeholder="Votre email" class="form-control">
            </div>
            
        
        
            <div class="col-12 col-md-4">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Votre mot de passe" class="form-control">
                <small id="emailHelp" class="form-text text-muted">Votre mot de passe doit contenir 8 caractères minimum</small>
            </div>
        </div>
        <button class="btn btn-secondary w-100">Connexion</button>
    </form>
    <div class="text-center">Pas encore de compte ? <a href="inscription">S'inscrire</a></div>
</div>