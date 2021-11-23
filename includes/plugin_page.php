<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


<div class="container">

<nav class="navbar navbar-expand-lg navbar-light my-4">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="admin.php?page=footscore/includes/plugin_page.php&home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php?page=footscore/includes/plugin_page.php&addmatch">Ajouter un match</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php?page=footscore/includes/plugin_page.php&classement">Voir le classement</a>
        </li>
      
      </ul>
    </div>
  </div>
</nav>


<?php 

if(isset($_GET['addmatch']))
{
include('add_match.php');
}
else if(isset($_GET['classement']))
{
  include('show_classement.php');
}
else
{
  echo "ici on ajoute les resultats";
}


?>

</div>