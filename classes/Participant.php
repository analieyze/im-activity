<?php

class Participant
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllParticipants()
    {
        $query = "SELECT * FROM participants
                  ORDER BY participant_id DESC
                  LIMIT 5";

        $stmt = $this->conn->query($query);

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addParticipants(
        $first_name,
        $last_name,
        $email,
        $gender,
        $birthdate,
        $city
    ) {
        $query = "INSERT INTO participants
                  (first_name, last_name, email, gender, birthdate, city)
                  VALUES
                  (:first_name, :last_name, :email, :gender, :birthdate, :city)";

        $statement = $this->conn->prepare($query);

        return $statement->execute([
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':gender' => $gender,
            ':birthdate' => $birthdate,
            ':city' => $city
        ]);
    }

    public function deleteParticipant($participant_id)
    {
        $query = "DELETE FROM participants
                  WHERE participant_id = :participant_id";

        $statement = $this->conn->prepare($query);

        return $statement->execute([
            ':participant_id' => $participant_id
        ]);
    }
}
?>