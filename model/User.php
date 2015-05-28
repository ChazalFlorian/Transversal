<?php

namespace model;

class User
{
    private $bdd;

    public function __construct($pdo)
    {
        $this->bdd = $pdo;
    }

    /**
     * fonction d'ajout d'user dans la base
     */
    public function addUser($data)
    {
        $request = $this->bdd->prepare('INSERT INTO users(Name, FirstName, Mail, Password, Phone, Subcription_ID) VALUES (:name, :firstname, :mail, :password, :phone, :subid)');
        $request->execute([
            'name' => $data['lastName'],
            'firstname' => $data['firstName'],
            'mail' => $data['mail'],
            'password' => sha1($data['password']),
            'phone' => $data['tel'],
            'subid' => (int) $data['radio']
        ]);
        return true;
    }


    /**
     * fonction qui compte les user ayant le mail X
     */
    public function countUserByMail($mail)
    {
        $request = $this->bdd->prepare('SELECT COUNT(*) as nb_user FROM users WHERE mail = :mail');
        $request->execute([
            'mail' => $mail
        ]);
        return $request->fetch()['nb_user'];
    }

    /**
     * fonction qui retourne un user avec mail
     */
    public function getUserByMail($mail)
    {
        $request = $this->bdd->prepare('SELECT * FROM users WHERE mail = :mail');
        $request->execute([
            'mail' => $mail
        ]);
        return $request->fetch();
    }



    public function getUserByID($ID){
        $request = $this->bdd->prepare('SELECT id, name, phone FROM users WHERE mail = :ID');
        $request->execute([
            'ID' => $ID
        ]);
        return $request->fetch();
    }

    /**
     * fonction qui retourne un user avec name et password
     */
    public function getUserByMailAndPassword($mail, $password)
    {
        $request = $this->bdd->prepare('SELECT ID, Name as name, FirstName , Mail, Phone, Subcription_ID FROM users WHERE mail = :mail AND password = :password');
        $request->execute([
            'mail' => $mail,
            'password' => sha1($password)
        ]);
        return $request->fetch();
    }

    public function getUserSubscription($mail){
        $request = $this->bdd->prepare('SELECT s.name FROM users u natural join subcriptions s WHERE mail = :mail');
        $request->execute([
            'mail' => $mail
        ]);
        return $request->fetch();
    }

    public function setUserSubscription($ID, $subID){
        $request = $this->bdd->prepare('UPDATE users SET subcription_ID = :subID WHERE ID = :id');
        $request->execute([
            'id' => $ID,
            'subID' => $subID
        ]);
    }

    public function getUserRDV($mail){
        $request = $this->bdd->prepare("SELECT u.name, u.phone, s.name, s.User/Price, s.desc, p.name, p.phone, p.adress, r.Date FROM users NATURAL JOIN
                                        rendezVous NATURAL JOIN
                                         services NATURAL JOIN
                                         partners WHERE u.mail = :mail");
        $request->execute([
            'mail' => $mail
        ]);
    }

    public function deleteUserByMail($mail){
        $request = $this->bdd->prepare("DELETE FROM users WHERE mail = :mail");
        $request->execute([
           'mail' => $mail
        ]);
    }
}