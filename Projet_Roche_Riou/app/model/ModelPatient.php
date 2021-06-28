
<!-- ----- debut ModelPatient -->

<?php
require_once 'Model.php';

class ModelPatient {
 private $id, $nom, $adresse;

 // pas possible d'avoir 2 constructeurs
 public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $adresse = NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($id)) {
   $this->id = $id;
   $this->nom = $nom;
   $this->prenom = $prenom;
   $this->adresse = $adresse;
  }
 }

 function setId($id) {
  $this->id = $id;
 }

 function setNom($nom) {
  $this->nom = $nom;
 }
 
 function setPrenom($prenom) {
  $this->prenom = $prenom;
 }

 function setAdresse($adresse) {
  $this->adresse = $adresse;
 }

 function getId() {
  return $this->id;
 }

 function getNom() {
  return $this->nom;
 }

  function getPrenom() {
  return $this->prenom;
 }

 function getAdresse() {
  return $this->adresse;
 }

 
 
// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select id from patient";
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
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select * from patient";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }
 
 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from patient where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
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
   $query = "select distinct region from patient";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelPatient");
   return $results;
     } catch (Exception $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;         
     }
 }*/
 public static function getRegionPatient(){
     // FUNTION REGION ICI
     try{
         $database = Model::getInstance();
   $query = "select region,count(*) from patient group by region";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   return $results;
     } catch (Exception $e) {
    printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
    return NULL;         
     }
 }
 public static function insert($nom, $prenom, $adresse) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from patient";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into patient value (:id, :nom, :prenom, :adresse)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'nom' => $nom,
     'prenom' =>$prenom,
     'adresse' => $adresse
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update() {
  echo ("ModelPatient : update() TODO ....");
  return null;
 }

 public static function delete($id) {
 try {

   // supprimer le tuple;
   $database = Model::getInstance();
  echo ("delete".$id);
   if ($id>=610){
      echo ("delete".$id);
   $query = "DELETE from patient where id=$id";
   echo $query;
   $statement = $database->prepare($query);
   $statement->execute();
   }else{
       $id=-1;
   }
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 
 }

}
?>
<!-- ----- fin ModelPatient -->
