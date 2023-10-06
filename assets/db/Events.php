<?php


class Events {

    var $id;
    var $attendees;
    var $nome_evento;
    var $data_evento;

    function __construct($id, $attendees, $nome_evento, $data_evento)
    {
        $this->id = $id;
        $this->attendees = $attendees;
        $this->nome_evento  = $nome_evento;
        $this->data_evento = $data_evento;
    }


    static public function getEvents($userEmail){
        $connection = DB::getConnection();
        $userEmail = $connection->real_escape_string($userEmail);
        $query = "SELECT * FROM `eventi` WHERE FIND_IN_SET('$userEmail', attendees) > 0";
        $result  = $connection->query($query);
        $events = [];
        $connection->close();

        while($row = $result->fetch_assoc()){
            $events[] = new Events(
                $row['id'],
                $row['attendees'],
                $row['nome_evento'],
                $row['data_evento'],
            );
        }

        return $events;
    }

    static public function show($eventName){
        $connection = DB::getConnection();

        $query = "SELECT * FROM `eventi` WHERE `nome_evento` = '$eventName'";
        $result  = $connection->query($query);
        $connection->close();

        if($result->num_rows > 0){
            $event = $result->fetch_assoc();
        }else{
            $event = null;
        }
        return $event;

    }

}
