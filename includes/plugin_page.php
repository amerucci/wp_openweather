<?php
require_once  __DIR__ . '/../Models/Database.php';
require_once  __DIR__ . '/../Models/Data.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>




<div class="container">

  <!-- Saisie de la clé d'API -->

  <div class="my-5 shadow p-3 mb-5 bg-white rounded">
    <h2>Clé API</h2>
    <?php

    $apikey = new Data;
    $existentkey = $apikey->getApiKey();





    echo '<form action="">';
    echo '<input type="hidden" name="page" value="acs-weather/includes/plugin_page.php">';
    echo ' <div class="form-group">';
    echo '<small id="passwordHelpBlock" class="form-text text-muted">
   Pour générer une clé API rendez-vous sur le site <a href="https://openweathermap.org/" target="blank">OpenWeather</a>.<br/>Créez un compte, puis par la suite rendez-vous dans l\'onglet "My API keys".
  </small>';
    echo '<div class="input-group my-3">
    <div class="input-group-prepend">
      <div class="input-group-text">Clé API</div>
    </div>';

    if ($existentkey == "") {
      echo '<input type="text" class="form-control" id="apikey" name="key" placeholder="Entrez votre clé API">';
    } else {
      echo '<input type="text" class="form-control" id="apikey" name="key" value="' . $existentkey['option_value'] . '" placeholder="Entrez votre clé API">';
    }



    echo '</div>';
    echo '</div>';

    echo "<div class='d-flex align-items-center'>";


    if ($existentkey == "") {
      echo '<button class="btn btn-primary id="save" name="save">Enregistrer la clé d\'API</button>';
    } else {
      echo '<button class="btn btn-primary id="update" name="update">Mettre à jour la clé d\'API</button>';
    }




    echo "</div>";
    echo '</form>';
    ?>
  </div>


  <!-- Génération du ShortColde-->

  <div class="my-5 shadow p-3 mb-5 bg-white rounded">
    <h2>Générer un shortcode</h2>
    <?php
    echo ' <div class="form-group">';
    echo '<label for="cpselect"><strong>Code Postal</strong></label>';
    echo '<input type="number" id="cpselect" name="commselected" class="form-control"/>';
    echo '<label for="commselect"><strong>Choisir une ville</strong></label>';
    echo '<input list="comm" id="commselect" name="commselected" class="form-control" readonly placeholder = "Selectionnez une ville"/>';
    echo "<datalist id='comm'>";
    echo '</datalist>';

    echo '<div class="input-group my-3">
    <div class="input-group-prepend">
      <div class="input-group-text">Shortcode</div>
    </div>
    <input type="text" class="form-control" id="generatedShortcode" readonly placeholder="Votre shortcode à copier">
  </div>';




    echo "<div id='generatedShortcode'></div>";
    echo '</div>';
    echo "<div class='d-flex align-items-center'>";
    echo '<button class="btn btn-primary float-left" id="copy" title="" data-original-title="Copy to clipboard">Copier le Shortcode</button><div id="successtxt" class="px-3 "></div>';
    echo "</div>";
    ?>
  </div>

  <script>
    document.getElementById("commselect").addEventListener('change', generateSchortcode);
    document.getElementById("cpselect").addEventListener('change', afficherLesCommunes);

    function generateSchortcode() {
      document.getElementById("generatedShortcode").value = '[meteo ville="' + this.value + '"]';

    }

    function copy() {
      var copyText = document.querySelector("#generatedShortcode");
      copyText.select();
      document.execCommand("copy");
      document.getElementById("successtxt").innerHTML = 'Le shortcode ' + document.getElementById("generatedShortcode").value + ' a bien été copié! '
    }

    function afficherLesCommunes() {

      var beforeSend = function() {
        document.getElementById("commselect").value = "Chargement en cours"
      }




      let laliste = document.getElementById("comm")
      laliste.innerHTML=""
      document.getElementById("commselect").value = ""
      document.getElementById("generatedShortcode").value = ""
      document.getElementById("commselect").placeholder = "Selectionnez une ville"
      document.getElementById("commselect").removeAttribute('readonly');

      let communeSelected = document.getElementById("cpselect").value
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {

        if (xmlhttp.readyState < 4) {
          beforeSend();
        }

        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("commselect").value = ""
          var communess = JSON.parse(this.response)



          for (let i = 0; i < communess.length; i++) {
            console.log(communess[i][0])
            laliste.innerHTML += '<option class="form-control" value="' + communess[i].nom + '">'
          }
        }
      }
      xmlhttp.open("GET", "../wp-content/plugins/acs-weather/includes/search.php?cp=" + communeSelected)

      xmlhttp.send()

    }

    document.querySelector("#copy").addEventListener("click", copy);
  </script>


  <!-- 
<nav class="navbar navbar-expand-lg navbar-light my-4">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php?page=acs-weather/includes/plugin_page.php&home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php?page=acs-weather/includes/plugin_page.php&addmatch">Ajouter un match</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php?page=acs-weather/includes/plugin_page.php&classement">Voir le classement</a>
        </li>
      
      </ul>
    </div>
  </div>
</nav> -->


  <?php




  if (isset($_GET['key']) && isset($_GET['save'])) {
    $apikey->setApiKey($_GET['key']);
  }

  if (isset($_GET['key']) && isset($_GET['update'])) {
    $apikey->updateApiKey($existentkey['option_id'], $_GET['key']);
  }


  if (isset($_GET['addmatch'])) {
    //include('add_match.php');
    echo "Vous êtes ici";
  } else if (isset($_GET['classement'])) {
    include('show_classement.php');
  } else {
    echo "Bienvenue";
  }


  ?>

</div>