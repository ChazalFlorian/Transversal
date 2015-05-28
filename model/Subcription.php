<?php

namespace model;

class Subcription{

    private $bdd;

    function __construct($pdo){
        $this->bdd = $pdo;
    }

    function getNameByID($ID){
        $request = $this->bdd->prepare("SELECT * FROM Subcription WHERE ID = :id");
        $request->execute([
            'id' => $ID
        ]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    function getAllSubcription(){
        $request = $this->bdd->prepare("SELECT * FROM Subcription");
        $request->execute();
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>