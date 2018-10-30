<?php

$currentPageTitle = "Ajoutez un film" ;


// Le fichier header.php est inclus sur la page
require_once(__DIR__.'/partials/header.php');

$title = $description = $video_link = null;
$cover = null;
$category_id_category = null;

// le formulaire est soumis

if (!empty($_POST)) {
    $title = $_POST['title'];
    $video_link = $_POST['video_link'];
    $description = $_POST['description'];
    $category_id_category = $_POST['category_id_category'];
    $cover = $_POST['cover'];

    // Définir un tableau d'erreur vide qui va se remplir après chaque erreur
     $errors = [];
    // Vérifier le titre
    if (empty($title)) {
        $errors['title'] = 'Le titre du film n\'est pas valide';
    }
    if (empty($cover)) {
        $errors['cover'] = 'Le titre du film n\'est pas valide';
    }
    // Vérifier le description
    if (empty($description)) {
        $errors['description'] = 'La description n\'est pas valide';
    }
    // Vérifier la vidéo
    if (empty($video_link)) {
        $errors['video_link'] = 'La video n\'est pas valide';
    }
    // Vérifier la catégorie
    //if (empty($category) || !in_array($category, ['Action', 'Horreur', 'Aventure', 'Animation'])) {
        //$errors['category_id'] = 'La catégorie n\'est pas valide';
    //}


    // S'il n'y a pas d'erreurs dans le formulaire
    if (empty($errors)) {
        $query = $db->prepare('
            INSERT INTO movie (`title`, `description`, `video_link` `cover`,  `category_idcategory`  ) VALUES (:title, :description, :video_link, :cover , :category_idcategory),
        ');
        
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':video_link', $video_link, PDO::PARAM_STR);
        $query->bindValue(':cover', $cover, PDO::PARAM_STR);
        $query->bindValue(':category_id_category', $category_id_category, PDO::PARAM_STR);
        if ($query->execute()) { // On insère le film dans la BDD
            $success = true;
            // Envoyer un mail ?
            // Logger la création du film
        }
    }

}

?>

    <?php if (isset($success) && $success) { ?>
        <div class="alert alert-success alert-dismissible fade show">
            La pizza <strong><?php echo $name; ?></strong> a bien été ajouté avec l'id <strong><?php echo $db->lastInsertId(); ?></strong> !
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

<div class="container contact-form">
    <div class="contact-image">
        <img src="assets/image/clap.png" alt="clap de film"/>
    </div>
    <form method="POST" enctype= "multipart/form-data">
        <h3><?php echo $currentPageTitle ;?></h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <input type="text" name="title" id="title" class="form-control" placeholder="Nom de votre film*" <?php echo isset($errors['title']) ? 'is-invalid' : null; ?>" value="<?php echo $title; ?>">
                    <?php if (isset($errors['title'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['title'];
                        echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="text" name="video_link" class="form-control" placeholder="URL de votre film*"/>
                </div>
                <div class="form-group">
                    <input type="text" name="cover" class="form-control" placeholder="Cover*"/>
                </div>
                <div class="form-group">
                    <select name="category_id_category" class="form-control"/>
                    <option value="">Choisir la catégorie</option>
                    <option <?php echo ($category_id_category === '1') ? 'selected' : ''; ?> value ="1">Action</option>
                    <option <?php echo ($category_id_category === '2') ? 'selected' : ''; ?> value ="2">Horreur</option>
                    <option <?php echo ($category_id_category === '3') ? 'selected' : ''; ?> value ="3">Aventure</option>
                    <option <?php echo ($category_id_category === '4') ? 'selected' : ''; ?> value ="4">Animation</option>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="description" class="form-control" placeholder="Description *" style="width: 100%; height: 202px;"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>

</main>

<?php echo 'nom du film : ' . $title . '<br/>';?>
<?php echo 'description : ' . $description . '<br/>'; ?>
<?php echo 'cover :' . $cover . '<br/>'; ?>
<?php echo 'category_id_category :' . $category_id_category . '<br/>'; ?>


<?php var_dump($video_link); ?>


<div class ="separator"></div>


<?php
// Le fichier footer.php est inclus sur la page
require_once(__DIR__.'/partials/footer.php'); ?>