
<!-- ----- debut ModelRendezvous -->

<?php
require_once 'Model.php';

class ModelRendezvous {

    private $id, $patient_id, $vaccin_id;

    // pas possible d'avoir 2 constructeurs
    public function __construct($centre_id = NULL, $patient_id = NULL, $injection = NULL, $vaccin_id = NULL) {
        // valeurs nulles si pas de passage de parametres
        if (!is_null($id)) {
            $this->id = $id;
            $this->patient_id = $patient_id;
            $this->injection = $injection;
            $this->vaccin_id = $vaccin_id;
        }
    }

    function setCentre_id($centre_id) {
        $this->centre_id = $centre_id;
    }

    function setPatient_id($patient_id) {
        $this->patient_id = $patient_id;
    }

    function setInjection($injection) {
        $this->injection = $injection;
    }

    function setVaccin_id($vaccin_id) {
        $this->vaccin_id = $vaccin_id;
    }

    function getCentre_id() {
        return $this->centre_id;
    }

    function getPatient_id() {
        return $this->patient_id;
    }

    function getInjection() {
        return $this->injection;
    }

    function getVaccin_id() {
        return $this->vaccin_id;
    }

// retourne une liste des id
    public static function getAllId() {
        try {
            $database = Model::getInstance();
            $query = "select patient_id from rendezvous";
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
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRendezvous");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

//fontion la 
    public static function getAll() {
        try {
            $database = Model::getInstance();
            $query = "select * from rendezvous";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRendezvous");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getOne($id) {
        try {
            $database = Model::getInstance();
            $query = "select * from rendezvous where patient_id = :id";
            echo $query;
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

    /* public static function getDistinctRegion(){
      // FUNTION REGION ICI
      try{
      $database = Model::getInstance();
      $query = "select distinct region from rendezvous";
      $statement = $database->prepare($query);
      $statement->execute();
      $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelRendezvous");
      return $results;
      } catch (Exception $e) {
      printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
      return NULL;
      }
      } */

    public static function getRegionRendezvous() {
        // FUNTION REGION ICI
        try {
            $database = Model::getInstance();
            $query = "select region,count(*) from rendezvous group by region";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            return $results;
        } catch (Exception $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($patient_id, $injection, $vaccin_id) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from rendezvous";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into rendezvous value (:id, :patient_id, :injection, :vaccin_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'patient_id' => $patient_id,
                'injection' => $injection,
                'vaccin_id' => $vaccin_id
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function update() {
        echo ("ModelRendezvous : update() TODO ....");
        return null;
    }

    public static function delete($id) {
        try {

            // supprimer le tuple;
            $database = Model::getInstance();
            echo ("delete" . $id);
            if ($id >= 610) {
                echo ("delete" . $id);
                $query = "DELETE from rendezvous where id=$id";
                echo $query;
                $statement = $database->prepare($query);
                $statement->execute();
            } else {
                $id = -1;
            }
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

}
?>
<!-- ----- fin ModelRendezvous -->
