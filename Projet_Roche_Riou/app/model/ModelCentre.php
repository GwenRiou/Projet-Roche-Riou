
<!-- ----- debut ModelCentre -->

<?php
require_once 'Model.php';

class ModelCentre {
 private $id, $label, $adresse;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $label = NULL, $adresse = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->label = $label;
   $this->adresse = $adresse;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setLabel($label) {
  $this->label = $label;
 }

 function setAdresse($adresse) {
  $this->adresse = $adresse;
 }

 function getId() {
  return $this->id;
 }

 function getLabel() {
  return $this->label;
 }

 function getAdresse() {
  return $this->adresse;
 }

 
 
// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from centre";
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
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAllLabelWithVaccin() {
  try {
   $database = Model::getInstance();
   //On sélectionne les labels des centres ayant au moins un vaccin de disponible
   $query = "SELECT DISTINCT c.label FROM centre c LEFT JOIN stock s ON s.centre_id = c.id WHERE s.quantite IS NOT NULL";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
public static function getAllLabel() {
     try {
   $database = Model::getInstance();
   $query = "SELECT label FROM centre";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0);   
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
public static function getAllLabelId() {
  try {
   $database = Model::getInstance();
   //On sélectionne les labels des centres ayant au moins un vaccin de disponible
   $query = "SELECT DISTINCT c.label, c.id FROM centre c LEFT JOIN stock s ON s.centre_id = c.id WHERE s.quantite IS NOT NULL";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 public static function getLabelfromId($id) {
        try {
            $database = Model::getInstance();
            $query = "select Label from centre where id = :id";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id
            ]);
            $results = $statement->fetchAll();
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
 public static function getIdLabelVaccin($vaccin_id){
    try {
   $database = Model::getInstance();
   //On sélectionne les labels des centres ayant au moins un vaccin de disponible
   $query = "SELECT DISTINCT c.label, c.id FROM centre c LEFT JOIN stock s ON s.centre_id = c.id WHERE s.quantite IS NOT NULL AND s.vaccin_id=:vaccin_id";
   $statement = $database->prepare($query);
   $statement->execute([ 
           'vaccin_id' => $vaccin_id,
           ]);
   $results = $statement->fetchAll();
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  } 
 }
 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from centre";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from centre where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
 public static function insert($label, $adresse) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from centre";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into centre value (:id, :label, :adresse)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'label' => $label,
     'adresse' => $adresse
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function linkVaccinToCentre() {
  try {
   $database = Model::getInstance();
   $query = "SELECT c.label centre, v.label vaccin, s.centre_id FROM centre c, vaccin v, stock s";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelCentre");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }



 public static function delete() {
 try {
 // supprimer le tuple;
    $database = Model::getInstance();

    //On récupère la liste de vaccins du centre sélectionné avec une quantité > 0
    $query = "SELECT v.label, s.quantite FROM stock s JOIN vaccin v ON s.vaccin_id = v.id WHERE s.centre_id = (SELECT c.id FROM centre c WHERE label = :label) AND s.quantite > 0 ORDER BY v.label ASC";
    $statement = $database->prepare($query);
    $statement->execute(['label' => $_GET['centre']]);
    $listeVaccin = $statement->fetchAll(PDO::FETCH_ASSOC);

    //Si la liste est vide (donc aucune quantité > 0), on peut supprimer le centre sélectionné
    if(empty($listeVaccin)) {
        //Suppression des stock dont l'id correspond à l'id du centre sélectionné
        $query = "DELETE FROM stock WHERE centre_id = (SELECT id FROM centre WHERE label = :label)";
        $statement = $database->prepare($query);
        $statement->execute(['label' => $_GET['centre']]);

        //Suppression du centre sélectionné
        $query = "DELETE FROM centre WHERE label = :label";
        $statement = $database->prepare($query);
        $statement->execute(['label' => $_GET['centre']]);
        return array();
    } else {
        return $listeVaccin;
    }
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 
 }

}
?>
<!-- ----- fin ModelCentre -->
