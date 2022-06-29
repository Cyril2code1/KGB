<?php

// if we got a post method and email and password aren't empty
if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){

    

// looking in the DB for data about the email    
    $db = new Database();
    $email = $_POST['email'];
    $sql = "SELECT * FROM administrators WHERE email = '$email'";
    $admin = $db->query($sql);

    $pwd = $admin[0]->password;

//  if passwords are ok, put id_admin data in a session cookie and back to the index   
    if(password_verify($_POST['password'], $pwd)){
        $_SESSION['auth'] = $admin[0]->id_admin;
        header('Location: ./../index.php');
        exit();
    } 
}

echo '<h2 class="text-danger">Page de connexion</h2>';

// create a form from the Form class
$form = new Form($_POST);

?>
<form method="post">

<div class="form-group">
<label class="col-sm-2 col-form-label"> email: (ex:admin@void.ru)</label>
<?= $form->input('email'); ?>
</div>


<div class="form-group">
<label class="col-sm-2 col-form-label"> mot de passe: (ex:Admin)</label>
<?= $form->input('password'); ?>
</div>

<?= $form->submit('se connecter'); ?>

</form>



