
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KGB</title>

    <!-- Bootstrap5 CSS -->
    <link href= "./../../bootstrap5/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS add -->

    <!--dossier ccs est bien au même niveau que dossier bootstrap5,
     donc ce n'est à priori pas un soucis de chemin.
     style.css est déclaré après bootstrap,
     donc devrait être pris en compte...
     mais le css ne s'applique pas .... -->

    <!--<link href= "./../../css/style.css" rel="stylesheet"> -->

  </head>

  <body>
    <header>
<!-- navbar start -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
<!-- navbar toggler button -->
          <button
          class="navbar-toggler collapsed"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#burgerized"
          aria-controls="burgerized"
          aria-expanded="false"
          aria-label="toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
<!-- navbar brand -->
          <a class="navbar-brand" href="#">
            <h1>KGB</h1>
          </a>
<!-- navbar collapsable menu -->
          <div class="collapse navbar-collapse" id="burgerized">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link active" href="./../" aria-current="page">Accueil</a>
              </li>
              <?php if (isset($_SESSION['auth'])): ?>
                <li class="nav-item">
                <a class="nav-link" href="./../../index.php?section=admin">Administration</a>

                <li class="nav-item">
                <a class="nav-link" href="./../../index.php?section=home&action=logout">Logout</a>
              </li>
              <?php else: ?>             
                <li class="nav-item">
                <a class="nav-link" href="./../../index.php?section=home&action=login">Login</a>
              </li>
              <?php endif; ?>
            </ul>
          </div> 
        </div>
      </nav>
    </header>

    <div class="container mt-3">
      <div>
        <?php echo $content; ?>
      </div>
    </div>


   

  </body>

  <!-- Bootstrap5 JavaScript -->
  <script src="./../../bootstrap5/js/bootstrap.bundle.min.js"></script>

<!-- Javascript add -->
  <script src="./../../js/admin_select_table.js"></script>
  <script src="./../../js/mission_details.js"></script>

</html>