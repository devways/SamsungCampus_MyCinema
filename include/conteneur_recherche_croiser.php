<div class="col-md-9">
  <div class="row">
    <div class="col-md-9">
      <?php 
      if(isset($requete_sql_count) && isset($limit) && $limit != "all" ) { 
        if(ceil((int)$tabl[0] / (int)$limit) != 1) { 
          ?>
          <div id="nav">
            <input type="submit" class="inline" name="p" value="1" form="recherche"><p class="inline">...</p>
            <?php 
            if (isset($_POST['p'])) { for($i = $_POST['p'] - 2; $i < $_POST['p'] + 3; $i++) { 
              if($i > 1 && $i < ceil((int)$tabl[0] / (int)$limit)) { 
                ?>
                <input type="submit" class="inline" name="p" value=<?php echo "\"" . $i . "\""; ?> form="recherche">
                <?php 
              }
            }
          }
          else { 
            for($i = 2; $i < 5; $i++){ 
              if($i > 1 && $i < ceil((int)$tabl[0] / (int)$limit)) { 
                ?>
                <input type="submit" name="p" class="inline" value=<?php echo "\"" . $i . "\""; ?> form="recherche"> 
                <?php 
              }
            }
          }
          ?>
          <p class="inline">...</p>
          <input type="submit" class="inline" name="p" value=<?php echo "\"" . ceil((int)$tabl[0] / (int)$limit) . "\""; ?> form="recherche"> 
        </div>
        <?php 
      }
    }
    ?>
  </div>
</div>
<div class="row h-scroll col-md-9">
  <table class="table-striped table-hover col-md-9">
    <?php
    if (isset($requete_sql)) {
      $requete_sql->execute(); 
      while ($tab = $requete_sql->fetch(PDO::FETCH_NUM)) {
        ?>
        <tr>
          <?php 
          foreach ($tab as $key => $value) { 
            if ($key == 0) {
              ?>
              <td>
                <a <?php echo "href=\"index.php?name_film=" . $tab[$key] . "\"";?>><?php echo $tab[$key]; ?></a>
              </td>
              <?php
            } 
            else { 
              ?>
              <td> <?php echo $tab[$key] ?> </td>
              <?php 
            }
          }
          ?>
        </tr>
        <?php
      }
    }
    ?>
  </table>
</div>
</div>
