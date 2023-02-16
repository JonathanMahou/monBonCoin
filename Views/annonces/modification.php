<div class="container">
<?php if ($errMsg) : ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Attention !</h4>
            <p class="bm-0"><?= $errMsg ?></p>
        </div>
    <?php endif ?>
</div>


<form method="POST" enctype="multipart/form-data">
    <select name="idCategorie" id="categorie" class="form-select">
        <option value="">Selectionner une catégorie :</option>
        <?php foreach ($categories as $categorie) : ?>
            <!-- J'ajoute "selected" si l'idCategorie de l'annonce correspond à l'idCategorie de la categorie -->
            <option value="<?= $categorie['idCategorie'] ?>" <?=$annonce['idCategorie'] == $categorie['idCategorie'] ? "selected" : null ?> ><?= ucfirst($categorie['title']) ?></option>
        <?php endforeach ?>
    </select>
    <div class="m-3">
        <label for="title" class="form-label">Nom de l'annonce</label>
        <input type="text" name="title" id="title" class="form-control" placeholder="titre" value="<?= $annonce['title'] ?>">
    </div>
    <div class="m-3 form-group">
        <label for="price" class="form-label">Prix</label>
        <div class="input-group">
            <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="Prix" value="<?= $annonce['price'] ?>">
            <span class="input-group-text">€</span>
        </div>
    </div>
    <div class="form-group"> 
        <label for="description" class="form-label mt-4">Description</label> 
        <textarea class="form-control" name="description" id="description" rows="3"><?= $annonce['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="photo" class="form-label">Photo</label>
        <p>Si vide nous conservons l'ancienne image : <img src="<?= SITEBASE ?>/img/annonces/<?= $annonce['image'] ?>"  alt="<?= $annonce['title']?>" class="logo"></p>


        <input type="file" name="image" id="image" class="form-control">
        <small class="form-text text-muted">(max 3Mo, format accépté : jpg, jpeg, png)</small>
    </div>
            <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
</form>