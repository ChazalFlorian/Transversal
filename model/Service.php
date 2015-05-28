<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27/05/2015
 * Time: 11:48
 */

namespace model;


class Service {
    private $PDO;

    function __construct($PDO){
        $this->PDO = $PDO;
    }

    function getRendezvousByID($ID){
        $request = $this->PDO->prepare("SELECT * FROM services WHERE ID = :user");
        $request->execute([
            'user' => $ID
        ]);
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }
}