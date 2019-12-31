<?php
class Ride
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getRides()
    {
        $this->db->query('SELECT posts.source,posts.destination,posts.departure,posts.vehicle,posts.seats,users.full_name FROM posts INNER JOIN users ON posts.user_id = users.id');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getUserRides()
    {
        $this->db->query('SELECT * FROM posts WHERE user_id=:userid');
        $this->db->bind(':userid', $_SESSION['user_id']);
        $results = $this->db->resultSet();
        return $results;
    }

    public function addRide($data)
    {

        $this->db->query('INSERT INTO posts (user_id,source,destination,departure,vehicle,seats) VALUES (:user_id, :source, :destination, :departure, :vehicle, :seats)');

        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':source', $data['source']);
        $this->db->bind(':destination', $data['destination']);
        $this->db->bind(':departure', $data['departure']);
        $this->db->bind(':vehicle', $data['vehicle']);
        $this->db->bind(':seats', $data['seats']);

        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRide($ride_id)
    {
        $this->db->query('DELETE FROM posts WHERE id= :rideid');
        $this->db->bind(':rideid', $ride_id);
        //execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getRideById($ride_id)
    {
        $this->db->query('SELECT * FROM posts WHERE id=:rideid');
        $this->db->bind(':rideid', $ride_id);
        $result = $this->db->single();
        return $result;
    }

    public function updateRide($data)
    {
        $this->db->query('UPDATE posts SET
                source = :source,
                destination = :destination,
                departure = :departure,
                vehicle = :vehicle,
                seats = :seats WHERE id=:rideid');
        $this->db->bind(':source', $data['source']);
        $this->db->bind(':destination', $data['destination']);
        $this->db->bind(':departure', $data['departure']);
        $this->db->bind(':vehicle', $data['vehicle']);
        $this->db->bind(':seats', $data['seats']);
        $this->db->bind(':rideid', $data['rideid']);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUserSession($ride_id){

        $this->db->query('SELECT user_id FROM posts WHERE id= :rideid');
        $this->db->bind(':rideid' , $ride_id);
        $user_id = $this->db->single();
        return $user_id;
    }
}
