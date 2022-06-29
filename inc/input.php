<h1 class="text-danger">Pensez à vérifier les données saisies avant de valider !</h1>

<?php
$form = new Form($_POST);
?>

<form method="post">

<div class="row mb-3">
  <label class="col-sm-3 col-form-label"> Serveur hôte: </label>
  <div class="col-sm-9">
    <?= $form->input('DB_HOST');?>
  </div>
</div>

<div class="row mb-3">
  <label class="col-sm-3 col-form-label"> Nom d'utilisateur: </label>
  <div class="col-sm-9">
    <?= $form->input('DB_USER');?>
  </div>
</div>

<div class="row mb-3">
  <label class="col-sm-3 col-form-label"> Mot de passe: </label>
  <div class="col-sm-9">
    <?= $form->input('DB_PASSWRD');?>
  </div>
</div>

<?= $form->submit('valider');?>

</form>

<?php
// once the form is submit ($_POST is no more empty) we create db_conf.php
if (!empty($_POST)) {
    File::Write_Conf();
    

// if the file is OK, create the DB, give some instructions and show a button to process further
    if (file_exists(CONF.'db_const.php')) {
        Database::create_db();
?>
    <div>
        <p>Le fichier db_const.php a été créé avec succès dans le dossier conf</p>
        <p><strong>Si besoin, il suffit de supprimer ce fichier et de revenir à l'index du site pour redémarrer le processus d'installation</strong></p>
        <p>la base de donnée cwd_kgb a été crée dans MySQL</p>
        <p><button class="btn btn-danger" onclick="window.location.href = 'index.php?section=install&action=tables';">continuer</button></p>
<?php 
    } else {
?>
        <p>Le processus de création du fichier db_config a échoué</p>
    </div>
<?php        
    }

}


