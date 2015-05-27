<?php
/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 17/05/2015
 * Time: 14:00
 */
namespace model;


class Partner{

    private $bdd;

    function __construct($PDO){
        $this->bdd = $PDO;
    }

    public function addPartner($mail, $password, $name, $phone, $responsible, $adress)
    {
        $request = $this->bdd->prepare('INSERT INTO partners (name, phone, responsible, adress, mail, password) VALUES (:name, ;phone, :responsible, :adress, :mail, :password)');
        $request->execute([
            'mail' => $mail,
            'password' => sha1($password),
            'name' => $name,
            'phone' => $phone,
            'responsible' => $responsible,
            'adress' => $adress
        ]);
    }

    /**
     * fonction qui compte les user ayant le mail X
     */
    public function countPartnerByMail($mail)
    {
        $request = $this->bdd->prepare('SELECT COUNT(*) as nb_user FROM partners WHERE mail = :mail');
        $request->execute([
            'mail' => $mail
        ]);
        return $request->fetch(PDO::FETCH_ASSOC)['nb_user'];
    }

    /**
     * fonction qui retourne un user avec mail
     */
    public function getPartnerByMail($mail)
    {
        $request = $this->bdd->prepare('SELECT id, name, adress, mail FROM partners WHERE mail = :mail');
        $request->execute([
            'mail' => $mail
        ]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * fonction qui retourne un user avec name et password
     */
    public function getPartnerByMailAndPassword($mail, $password)
    {
        $request = $this->bdd->prepare('SELECT id, name, adress, mail FROM partners WHERE mail = :mail AND password = :password');
        $request->execute([
            'mail' => $mail,
            'password' => sha1($password)
        ]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function getPartnerRendezVous($mail){
        $request = $this->bdd->prepare("SELECT u.name, u.phone, s.name, s.User/Partner, p.name, p.phone, p.adress, r.Date FROM users NATURAL JOIN
                                        rendezVous NATURAL JOIN
                                         services NATURAL JOIN
                                         partners WHERE p.mail = :mail");
        $request->execute([
            'mail' => $mail
        ]);
    }
}

?>