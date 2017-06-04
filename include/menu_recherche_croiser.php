<div class="col-sm-3 col-md-3 sidebar">
  <form method="POST" action="index.php" id="recherche">
    <label><span class="label label-default">TITRE</span></label>
    <input type="text" class="form-control" placeholder="Search..." name="titre" 
    <?php 
    if(isset($_POST["titre"]) && $_POST["titre"] != "") { 
      echo "value=\"" . htmlspecialchars($_POST["titre"]) . "\"";
    }
    ?>
    >
    <label><span class="label label-default">GENRE</span></label>
    <select class="form-control" name="categorie">
      <option>all</option>
      <?php
      $tableau = $db->query("SELECT nom FROM tp_genre ORDER BY nom ASC");
      while($tabl = $tableau->fetch()) { 
        ?>
        <option 
        <?php 
        if(isset($_POST["categorie"]) && $tabl["nom"] == htmlspecialchars($_POST["categorie"])) {
          echo "selected";
        } 
        ?>
        >
        <?php 
        echo $tabl['nom'];
        ?>
      </option>
      <?php 
    } 
    ?>
  </select>
  <label><span class="label label-default">DISTRIBUTEUR</span></label>
  <select class="form-control" name="distrib">
    <option>all</option>
    <?php
    $tableau = $db->query("SELECT nom FROM tp_distrib ORDER BY nom ASC");
    while($tabl = $tableau->fetch()){ 
      ?>
      <option <?php if(isset($_POST["distrib"]) && $tabl["nom"] == htmlspecialchars($_POST["distrib"])) {echo "selected";} ?>><?php echo $tabl["nom"];?></option>
      <?php 
    }
    ?>
  </select>
  <label><span class="label label-default">NBR ELEMENT PAR PAJE</span></label>
  <select class="form-control" name="limit">
    <option <?php if(isset($_POST["limit"]) && "all" == $_POST["limit"]){echo "selected";} ?>>all</option>
    <option <?php if(isset($_POST["limit"]) && 10 == $_POST["limit"]){echo "selected";} ?>>10</option>
    <option <?php if(isset($_POST["limit"]) && 20 == $_POST["limit"]){echo "selected";} ?>>20</option>
    <option <?php if(isset($_POST["limit"]) && 30 == $_POST["limit"]){echo "selected";} ?>>30</option>
  </select>
  <label><span class="label label-default">CHOIX DE PAJE</span></label>
  <?php
  if(isset($_POST["limit"])) {
    $requete_sql_count->execute(); $tabl = $requete_sql_count->fetch();
  }
  ?>
  <input type="number" class="form-control" placeholder="Search..." name="p" min=1 <?php if(isset($_POST["limit"]) && htmlspecialchars($_POST["limit"]) != "all") { ?> max=<?php echo "\"" . ceil((int)$tabl[0] / (int)$limit) . "\""?>  <?php 
}
if(isset($_POST['p'])) { 
  echo "value=\"" . htmlspecialchars($_POST["p"]) . "\"";
}
else {
  echo "value=\"1\"";
} 
?>
>
<input type="submit" value="valider">
</form>
</div>