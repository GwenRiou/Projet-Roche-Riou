
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
    


    public static function insert($id) {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from rendezvous";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into rendezvous values (:centre_id, :patient_id, :injection, :vaccin_id)";
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

    public static function creation($patient_id, $centre_id, $injection,$vaccin_id) {
        try {
            $database = Model::getInstance();
            
            if ($injection == 1) {
                $query = "SELECT vaccin_id,quantite FROM
                (
                    SELECT * FROM stock WHERE centre_id = '$centre_id' )AS stockCentre
                    WHERE quantite = (SELECT MAX(quantite)FROM (SELECT * FROM stock WHERE centre_id = '$centre_id' )AS stockCentre);";
                $statement = $database->prepare($query);
                $statement->execute();
                $vaccin_id = $statement->fetchAll();
                
                $vaccin_quantite = $vaccin_id[0][1];
                $vaccin_quantite = $vaccin_quantite - 1;
                $vaccin_id=$vaccin_id[0][0];
                
            } else if ($injection == 2) {
                $query = "SELECT quantite FROM stock WHERE centre_id = :centre_id AND vaccin_id=:vaccin_id";
                $statement = $database->prepare($query);
                $statement->execute([
                    'centre_id' => $centre_id,
                    'vaccin_id' => $vaccin_id,
                ]);
                $vaccin_quantite = $statement->fetchAll();
                
                $vaccin_quantite=$vaccin_quantite[0][0];
                $vaccin_quantite = $vaccin_quantite - 1;
            }
            

            $query = "UPDATE  stock SET quantite=$vaccin_quantite WHERE centre_id = :centre_id AND vaccin_id =:vaccin_id";
            $statement = $database->prepare($query);
            $statement->execute([
                'centre_id' => $centre_id,
                'vaccin_id' => $vaccin_id,
            ]);

            $query = "insert into rendezvous values(:centre_id, :patient_id, :injection, :vaccin_id)";
            $statement = $database->prepare($query);
            $statement->execute([
                'centre_id' => $centre_id,
                'patient_id' => $patient_id,
                'injection' => $injection,
                'vaccin_id' => $vaccin_id,
            ]);
            return null;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    

}
?>
<!-- ----- fin ModelRendezvous -->
