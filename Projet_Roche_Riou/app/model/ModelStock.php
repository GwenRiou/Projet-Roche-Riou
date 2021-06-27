
<!-- ----- debut ModelStock -->

<?php
require_once 'Model.php';

class ModelStock {
 private $centre_id, $vaccin_id, $quantite;

 // pas possible d'avoir 2 constructeurs
 public function __construct($centre_id = NULL, $vaccin_id = NULL, $quantite = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($centre_id)) {
   $this->centre_id = $centre_id;
   $this->vaccin_id = $vaccin_id;
   $this->quantite = $quantite;
  }
 }

 function setCentre_id($centre_id) {
  $this->centre_id = $centre_id;
 }

 function setVaccin_id($vaccin_id) {
  $this->vaccin_id = $vaccin_id;
 }

 function setQuantite($quantite) {
  $this->quantite = $quantite;
 }

 function getCentre_id() {
  return $this->centre_id;
 }

 function getVaccin_id() {
  return $this->vaccin_id;
 }

 function getQuantite() {
  return $this->quantite;
 }

 
 
// retourne une liste des centre_id
 public static function getAllCentre_id() {
  try {
   $database = Model::getInstance();
   $query = "select centre_id from stock";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getMany($query) {
  try {
   $database = Model::getInstance();
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelStock");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from stock";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelStock");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 public static function getTotal() {
  try {
   $database = Model::getInstance();
   $query = "select centre_id,SUM(quantite) from stock group by centre_id";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
 public static function getAllVaccin($label) {
  try {
   $database = Model::getInstance();
   //On récupère le nombre de vaccins différents dans un centre particulier
   $query = "SELECT COUNT(*) FROM stock s, centre c, vaccin v WHERE s.centre_id = c.id AND s.vaccin_id = v.id AND c.label = '$label' ORDER BY v.label ASC";
   $statement = $database->prepare($query);
   $statement->execute(['label' => $label]);
   $nb_vaccins = $statement->fetchColumn();
   
   //On récupère les id de chaque vaccin ainsi que leur nom afin de les afficher et de plus tard faire correspondre les doses
   $query = "SELECT s.vaccin_id, v.label FROM stock s, centre c, vaccin v WHERE s.centre_id = c.id AND s.vaccin_id = v.id AND c.label = '$label' ORDER BY v.label ASC";
   $statement = $database->prepare($query);
   $statement->execute(['label' => $label]);
   if ($nb_vaccins > 0) {
        for ($i=1; $i<=$nb_vaccins; $i++) {
            $results[] = $statement->fetch(PDO::FETCH_ASSOC);
        }
   } else {
       $results = -2; 
   }
   //print_r($results);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 /*public static function getDistinctRegion(){
     // FUNTION REGION ICI
     try{
         $database = Model::getInstance();
   $query = "select distinct region from stock";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelStock");
   return $results;
     } catch (Exception $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;         
     }
 }*/
 public static function getRegionStock(){
     // FUNTION REGION ICI
     try{
         $database = Model::getInstance();
   $query = "select region,count(*) from stock group by region";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
     } catch (Exception $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;         
     }
 }
 public static function insert($vaccin_id, $quantite) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(centre_id) + 1
   $query = "select max(centre_id) from stock";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $centre_id = $tuple['0'];
   $centre_id++;

   // ajout d'un nouveau tuple;
   $query = "insert into stock value (:centre_id, :vaccin_id, :quantite)";
   $statement = $database->prepare($query);
   $statement->execute([
     'centre_id' => $centre_id,
     'vaccin_id' => $vaccin_id,
     'quantite' => $quantite
   ]);
   return $centre_id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update() {
    try {
    $database = Model::getInstance();
    $query = "SELECT id FROM centre WHERE label = :label";
    $statement = $database->prepare($query);
    $statement->execute(['label' => $_GET['label']]);
    $id = $statement->fetchColumn();
    
    foreach ($_GET as $key => $value) {
        $query = "UPDATE stock SET quantite = quantite + :doses WHERE vaccin_id = :vaccin_id AND centre_id = :id";
        $statement = $database->prepare($query);
        $statement->execute([
            'vaccin_id' => $key, 
            'doses' => $value, 
            'id' => $id
        ]);
    }
  
  return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   //printf("%s", $id);
   return -1;
  }
 }
 
/* public static function getAllLabel() {
  try {
   $database = Model::getInstance();
   $query = "select label from centre";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }*/
 
 public static function reapprovisionnement() {
  try {
   $database = Model::getInstance();
   $limite = 5;
   //foreach($centre_label as $value) {
        $query = "SELECT c.label centre, v.label vaccin, s.quantite, :limite limite FROM centre c, stock s, vaccin v WHERE c.id = s.centre_id AND v.id = s.vaccin_id AND s.quantite < :limite ORDER BY c.label, v.label ASC";
        $statement = $database->prepare($query);
        $statement->execute(['limite' => $limite]);
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
   //}
   
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function delete($centre_id) {
 try {

   // supprimer le tuple;
   $database = Model::getInstance();
  echo ("delete".$centre_id);
   if ($centre_id>=610){
      echo ("delete".$centre_id);
   $query = "DELETE from stock where centre_id=$centre_id";
   echo $query;
   $statement = $database->prepare($query);
   $statement->execute();
   }else{
       $centre_id=-1;
   }
   return $centre_id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 
 }

}
?>
<!-- ----- fin ModelStock -->
