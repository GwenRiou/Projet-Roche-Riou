
<!-- ----- debut ModelRecolte -->

<?php
require_once 'Model.php';

class ModelRecolte {
 private $producteur_id, $vin_id, $quantite;

 // pas possible d'avoir 2 constructeurs
 public function __construct($producteur_id=NULL, $vin_id=NULL, $quantite=NULL) {
  // valeurs nulles si pas de passage de parametres
  if (!is_null($producteur_id)) {
   $this->producteur_id = $producteur_id;
   $this->vin_id = $vin_id;
   $this->quatite = $quantite;
  }
 }

 function setProducteurId($producteur_id) {
  $this->producteur_id = $producteur_id;
 }

 function setVin_id($vin_id) {
  $this->vin_id = $vin_id;
 }

 function setQuantite($quantite) {
  $this->quantite = $quantite;
 }

 function getProducteur_id() {
  return $this->producteur_id;
 }

 function getVin_id() {
  return $this->vin_id;
 }

 function getQuantite() {
  return $this->quantite;
 }

 
// retourne une liste des id
 public static function getAllId() {
  try {
   $database = Model::getInstance();
   $query = "select * from vin";
   //$query = "select vin_id,cru,annee,degre,producteur_id, from vin, producteur, recolte where recolte.vin_id = vin.id and recolte.producteur_id = producteur.id ";
   $statement = $database->prepare($query);
   $statement->execute();
   $resultsVin = $statement->fetchAll();
   $query = "select * from producteur";
   $statement = $database->prepare($query);
   $statement->execute();
   $resultProducteur = $statement->fetchAll();   
   return array($resultsVin,$resultProducteur);     
   
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
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRecolte");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getAll() {
  try {
   $database = Model::getInstance();
   $query = "select region, cru, annee, degre, nom, prenom, quantite from vin,
producteur, recolte where recolte.vin_id = vin.id and recolte.producteur_id =
producteur.id order by region";
   $statement = $database->prepare($query);
   $statement->execute();
   $results = $statement->fetchAll();
   //$cols= array("region", "cru", "annee", "degre", "nom", "prenom", "quantite");
   //$datas=$results;
   //echo"ModelResul";
   //print_r($datas);
   //return array($cols, $datas);
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function getOne($id) {
  try {
   $database = Model::getInstance();
   $query = "select * from recolte where id = :id";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id
   ]);
   $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRecolte");
   return $results;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return NULL;
  }
 }

 public static function insert($vin_id, $quantite, $degre) {
  try {
   $database = Model::getInstance();

   // recherche de la valeur de la clé = max(id) + 1
   $query = "select max(id) from recolte";
   $statement = $database->query($query);
   $tuple = $statement->fetch();
   $id = $tuple['0'];
   $id++;

   // ajout d'un nouveau tuple;
   $query = "insert into recolte value (:id, :vin_id, :quantite, :degre)";
   $statement = $database->prepare($query);
   $statement->execute([
     'id' => $id,
     'vin_id' => $vin_id,
     'quantite' => $quantite,
     'degre' => $degre
   ]);
   return $id;
  } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function update($producteur_id,$vin_id,$quantite) {
     try {
     $database = Model::getInstance();
     $test="select * from recolte where producteur_id = $producteur_id AND vin_id=$vin_id";
     $statement = $database->query($query);
     $tuple = $statement->fetch();
     if($tuple!=""){//la requette existe
         if($quantite===$this->getQuantite()){
             echo "Le tuplet exsite déjà";             
             return -1;
         }else{
            echo"mise à jour";
            $query = "update recolte set quantite=$quantite where producteur_id=$producteur_id AND vin_id=$vin_id ";
            $statement = $database->prepare($query);
            $statement->execute();
            return array($producteur_id,$vin_id);
         }
         
     }else{
         echo "création du tuplue";
          $query = "insert into recolte value (:producteur_id, :vin_id, :quantite)";
          $statement = $database->prepare($query);
          $statement->execute([
          'producteur_id' => $producteur_id,
          'vin_id' => $vin_id,
          'quantite' => $quantite
          ]);
          return array($producteur_id,$vin_id);
     }
     } catch (PDOException $e) {
   printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
   return -1;
  }
 }

 public static function delete($id) {
  try {

   // supprimer le tuple;
   $database = Model::getInstance();
   
  
   if ($id>=101){
   $query = "DELETE from recolte where id=$id";
   
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
<!-- ----- fin ModelRecolte -->
