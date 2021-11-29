<?php
require_once  __DIR__ . '/../Models/Database.php';
require_once  __DIR__ . '/../Models/Data.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

<style>
  input[type=checkbox]:checked::before {
    content: "" !important;
    margin: -0.1875rem 0 0 -0.25rem;
    height: 1.3125rem;
    width: 1.3125rem;
  }

  .form-check .form-check-input {
    float: none !important;
  }

  .btn-primary {
    color: #fff;
    background-color: #2271b1;
    border-color: #2271b1;
  }

  .form-check-input:checked {
    background-color: #2271b1;
    border-color: #2271b1;
  }
</style>


<?php

// global $wpdb;
// var_dump($wpdb);
?>

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

  <!-- GESTION DE LA PAGE METEO -->

  <div class="my-5 shadow p-3 mb-5 bg-white rounded">
    <h2>Gestion de la page météo</h2>
    <small id="passwordHelpBlock" class="form-text text-muted">
      Pour pouvez ici gérer les options d'affichages de la page météo<br />
      Pour commencer choisissez ci-dessus la ville sur laquelle vous souhaitez travailler.<br />

    </small>
    <?php
    echo ' <div class="form-group">';
    echo '<label for="cpselect2"><strong>Code Postal</strong></label>';
    echo '<input type="number" id="cpselect2" name="commselected" class="form-control"/>';
    echo '<label for="commselect2"><strong>Choisir une ville</strong></label>';
    echo '<input list="comm2" id="commselect2" name="commselected" class="form-control" readonly placeholder = "Selectionnez une ville"/>';
    echo "<datalist id='comm2'>";
    echo '</datalist>';

    echo '<form action="">';
    echo '<input type="hidden" name="page" value="acs-weather/includes/plugin_page.php">';
 
    echo ' <div class="form-group">';
    echo '<div class="row my-3">';
    echo '<div class="col-12 col-md-6">';
    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="ressenti" id="ressenti">
      <label class="form-check-label" for="ressenti">
        Ressenti
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="tempmin" id="tempmin">
      <label class="form-check-label" for="tempmin">
        Température minimale
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="tempmax" id="tempmax">
      <label class="form-check-label" for="tempmax">
      Température maximale
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="humidite" id="humidite">
      <label class="form-check-label" for="humidite">
        Humidité
      </label>
    </div>';

    echo '</div>';
    echo '<div class="col-12 col-md-6">';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox"  name="arguments[]" value="nebulosite" id="nebulosite">
      <label class="form-check-label" for="nebulosite">
        Nébulosité
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="vitessevent" id="windspeed">
      <label class="form-check-label" for="windspeed">
      Vitesse du vent
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="visibilite" id="visibility">
      <label class="form-check-label" for="visibility">
      Visibilité moyenne
      </label>
    </div>';

    echo '
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="arguments[]" value="pecipitation" id="pop">
      <label class="form-check-label" for="pop">
      Précipitations
      </label>
    </div>';

    echo '</div>';
    echo '</div>';

   
    
    echo '<input type="text" id="rendufinal" class="form-control" name="rendufinal" readonly>';
    echo '<button class="btn btn-primary id="save" name="savereglage">Sauvegarder les réglages</button>';
    echo '</form>';


    echo "</div>";
    ?>
  </div>


  <script>
    document.getElementById("commselect").addEventListener('change', generateSchortcode);
    document.getElementById("commselect").addEventListener('change', generateVille);
    document.getElementById("commselect2").addEventListener('change', generateVille2);
    document.getElementById("cpselect").addEventListener('change', afficherLesCommunes);
    document.getElementById("cpselect2").addEventListener('change', afficherLesCommunes2);
    let rendu = document.getElementById("rendufinal")
    let ville
    let ville2

    function generateSchortcode() {
      document.getElementById("generatedShortcode").value = '[meteo ville="' + this.value + '"]';


    }

    function generateVille() {
      ville = this.value;

    }

    function generateVille2() {
      ville2 = this.value;
      rendu.value = 
      rendu.value = '[pagemeteo ville="'+this.value+'"]'

    }
    
    /**
     * Copier le shortCode dans le press papier
     *
     * @return void
     */
    function copy() {
      var copyText = document.querySelector("#generatedShortcode");
      copyText.select();
      document.execCommand("copy");
      document.getElementById("successtxt").innerHTML = 'Le shortcode ' + document.getElementById("generatedShortcode").value + ' a bien été copié! '
    }

    function afficherLesCommunes() {
      let beforeSend = function() {
        document.getElementById("commselect").value = "Chargement en cours"
      }
      let laliste = document.getElementById("comm")
      laliste.innerHTML = ""
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
          let communess = JSON.parse(this.response)
          for (let i = 0; i < communess.length; i++) {
            console.log(communess[i][0])
            laliste.innerHTML += '<option class="form-control" value="' + communess[i].nom + '">'
          }
        }
      }
      xmlhttp.open("GET", "../wp-content/plugins/acs-weather/includes/search.php?cp=" + communeSelected)
      xmlhttp.send()
    }


    function afficherLesCommunes2() {
      let beforeSend = function() {
        document.getElementById("commselect2").value = "Chargement en cours"
      }
      let laliste = document.getElementById("comm2")

      laliste.innerHTML = ""
      document.getElementById("commselect2").value = ""
      document.getElementById("generatedShortcode").value = ""
      document.getElementById("commselect2").placeholder = "Selectionnez une ville"
      document.getElementById("commselect2").removeAttribute('readonly');
      let communeSelected = document.getElementById("cpselect2").value
      let xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState < 4) {
          beforeSend();
        }
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("commselect2").value = ""
          let communess = JSON.parse(this.response)
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



    //Gestion des paramètres d'affichage de la page météo

    let lesparams = []

    //let inputs = document.querySelectorAll(".form-check-input");
    // for (let i = 0; i < inputs.length; i++) {
    //   inputs[i].addEventListener('change', function() {

    //     if (inputs[i].checked == true) {
    //       lesparams.push(inputs[i].value);
    //       generateMeteo()

    //     } else {
    //       if(lesparams.indexOf(inputs[i].value) !== -1){
    //         let position = lesparams.indexOf(inputs[i].value)
    //         lesparams.splice(position,1)
    //         generateMeteo()
    //       }
    //       else{
    //         generateMeteo()
    //       }

    //     }

    //     function generateMeteo() {

    //       output = lesparams.join(' ')
    //       rendu.value = "[pagemeteo ville='"+ville+"' "+output+"]"
    //     }

    //    // console.log(lesparams)

    //   })

    // }
  </script>





  <?php




  if (isset($_GET['key']) && isset($_GET['save'])) {
    $apikey->setApiKey($_GET['key']);
  }

  if (isset($_GET['key']) && isset($_GET['update'])) {
    $apikey->updateApiKey($existentkey['option_id'], $_GET['key']);
  }

  if (isset($_GET['savereglage']) && isset($_GET['rendufinal'])) {
    //echo $_GET['rendufinal'];
    $rendunormalized = str_replace('\"', '"', $_GET['rendufinal']);
    //echo $rendunormalized;

    $arguments = $_GET["arguments"];

    echo "<b>Vous aimez </b><br />";
    for ($i=0; $i<count($arguments); $i++) {
        echo $arguments[$i]."<br />";
    }


   
    $apikey->setMeteoArgs($rendunormalized, $arguments);
  }




  ?>

</div>