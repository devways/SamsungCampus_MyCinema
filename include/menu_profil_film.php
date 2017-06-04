<form method="post" action="profil.php">
	<label>
    <span class="label label-default">GENRE</span>
  </label>
  <select class="form-control" name="categorie">
    <?php
    $tableau = $db->query("SELECT nom FROM tp_genre ORDER BY nom ASC");
    while($tabl = $tableau->fetch()) { 
      ?>
      <option 
      <?php 
      if(isset($_POST["categorie"]) && $tabl["nom"] == $_POST["categorie"]) {
        echo "selected";
      } 
      ?>
      >
      <?php 
      echo $tabl['nom'];?>  
    </option>
    <?php 
  } 
  ?>
</select>
<label>
  <span class="label label-default">DISTRIBUTEUR</span>
</label>
<select class="form-control" name="distrib">
  <?php
  $tableau = $db->query("SELECT nom FROM tp_distrib ORDER BY nom ASC");
  while($tabl = $tableau->fetch()){ 
    ?>
    <option 
    <?php 
    if(isset($_POST["distrib"]) && $tabl["nom"] == htmlspecialchars($_POST["distrib"])) {
      echo "selected";
    } 
    ?>
    >
    <?php 
    echo $tabl["nom"];
    ?>
  </option>
  <?php
}
?>
</select>
<input type="text" name="titre">
<input type="text" name="resum">
<input type="date" name="date_debut">
<input type="date" name="date_fin">
<input type="number" min="0" name="duree_min">
<input type="number" min="1900" max="2099" name="annee_prod">
<input type="submit" value="ajouter">
</form>