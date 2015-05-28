<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 17/05/2015
 * Time: 18:46
 */

namespace model;


class Rendezvous {
    private $PDO;

    function __construct($PDO){
        $this->PDO = $PDO;
    }

    function AddRendezvous($idUser, $idService, $date){
        $request = $this->PDO->prepare("INSERT INTO rendezVous (User_ID Service_ID, Date) VALUES (:user, :service, :date)");
        $request->execute([
            'user' => $idUser,
            'service' => $idService,
            'date' => $date
        ]);
    }

    function getRendezvousByUser($idUser){
        $request = $this->PDO->prepare("SELECT * FROM rendezVous WHERE User_ID = :user");
        $request->execute([
            'user' => $idUser
        ]);
        return $request->fetchAll(\PDO::FETCH_ASSOC);
    }

    function getRendezvousByService($idService){
        $request = $this->PDO->prepare("SELECT * FROM rendezVous WHERE Service_ID = :service");
        $request->execute([
            'service' => $idService
        ]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    function getRendezvousByDate($date){
        $request = $this->PDO->prepare("SELECT * FROM rendezVous WHERE Date = :date");
        $request->execute([
            'date' => $date
        ]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    function getRendezvousByUserAndDate($idUser, $date){
        $request = $this->PDO->prepare("SELECT * FROM rendezVous WHERE User_ID = :user AND Date = :date");
        $request->execute([
            'user' => $idUser,
            'date' => $date
        ]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }

    function getRendezvousByServiceAndDate($idService, $date){
        $request = $this->PDO->prepare("SELECT * FROM rendezVous WHERE User_ID = :service AND Date = :date");
        $request->execute([
            'service' => $idService,
            'date' => $date
        ]);
        return $request->fetch(\PDO::FETCH_ASSOC);
    }



}