
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>

    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th scope = "col">id</th>
          <th scope = "col">label</th>
          <th scope = "col">adresse</th>
        </tr>
      </thead>
      <tbody>
          <?php
          // La liste des centres est dans une variable $results             
          foreach ($results as $element) {
            printf("<tr><td>%d</td><td>%s</td>", $element->getId(), 
             $element->getLabel());
           printf("<td><a href='http://maps.google.com/maps?f=d&amp;daddr=%s' target='_blank'>%s</a></td>",
                   $element->getAdresse(),$element->getAdresse());
           echo "</tr>";
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  
