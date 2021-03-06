<nav class="navbar navbar-inverse">
  <div class="container-fluid col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/ZHEVHUYLFH/pages/index.php">PPE3</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
            <a href="/ZHEVHUYLFH/pages/index.php">Accueil</a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Médicament<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/medicament/">Liste</a>
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/medicament/medicament_upd.php">Création</a>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Praticien<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/praticien/">Liste</a>
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/praticien/praticien_upd.php">Création</a>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employé<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/profil/">Liste</a>
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/profil/profil_upd.php">Création</a>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Rapport<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/rapport/">Liste</a>
                <li class="dropdown-perso"><a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php">Création</a>
            </ul>
        </li>
        <?php
        $profils=$db->prepare('SELECT * FROM ppe_visiteur WHERE VIS_MATRICULE = :matricule');
      		$profils->bindValue(':matricule',$_SESSION['login'], PDO::PARAM_STR);
      		$profils->execute();
      		$profil=$profils->fetch();
        ?>
        <li>
            <a href="/ZHEVHUYLFH/deco.php">Connecté en tant que <?php echo $profil['VIS_PRENOM']." ".$profil['VIS_NOM'] ?></a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/deco.php">Déconnexion</a>
        </li>
        <!-- <li>
            <a href="/ZHEVHUYLFH/pages/medicament/index.php">Med Liste</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/medicament/medicament_upd.php">Med upd</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/praticien/index.php">Praticien Liste</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/praticien/praticien_upd.php">Praticien upd</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/profil/index.php">employé Liste</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/profil/profil_upd.php">employé upd</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/rapport/index.php">rapport Liste</a>
        </li>
        <li>
            <a href="/ZHEVHUYLFH/pages/rapport/rapport_upd.php">rapport upd</a>
        </li> -->
        <!-- <li>
            <a href="map.php">Recherche</a>
        </li>
        <li>
            <a href="map.php?search=pharmacie">Pharmacie</a>
        </li> -->
        <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Homme<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="map.php?search=homme,chaussures">Chaussures Homme</a>
                <li class="dropdown-perso"><a href="map.php?search=homme, vêtements">Vêtements Homme</a>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Femme<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="dropdown-perso"><a href="map.php?search=femme,chaussures">Chaussures Femme</a>
                <li class="dropdown-perso"><a href="map.php?search=femme,vêtements">Vêtements Femme</a>
            </ul>
        </li> -->
      </ul>
      <!-- <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul> -->
      <!-- <form class="navbar-form navbar-right" role="search" method="get" action="map.php">
        <div class="form-group">
          <input type="text" class="form-control" name="search" placeholder="Rechercher">
        </div>
        <button type="submit" class="btn btn-default">Valider</button>
      </form> -->
    </div>
  </div>
</nav>

<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
