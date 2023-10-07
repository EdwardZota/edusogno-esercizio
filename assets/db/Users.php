<?php 

class Users {
    var $id;
    var $nome;
    var $cognome;
    var $email;
    var $permessi_admin;

    function __construct($id, $nome, $cognome, $email, $permessi_admin)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome  = $cognome;
        $this->email = $email;
        $this->permessi_admin  = $permessi_admin;
    }


    static public function getUser(){
        $connection = DB::getConnection();
        $query = "SELECT * FROM `utenti`";

        $result = $connection->query($query);
        $users=[];

        while ($row = $result->fetch_assoc()) {
            $users[] = new Users(
                $row['id'],
                $row['nome'],
                $row['cognome'],
                $row['email'],
                $row['permessi_admin']
            );
        }
        $connection->close();
        return $users;

    }

}