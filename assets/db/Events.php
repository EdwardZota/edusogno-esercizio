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


    static public function getEvents(){
        $connection = DB::getConnection();
        $query = "SELECT * FROM `eventi`";
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
}
