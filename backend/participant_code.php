<?php
require_once '../connection.php';
require_once '../classes/Participant.php';

$participant = new Participant($conn);

if (isset($_POST['add_participant'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];

    if ($participant->addParticipants($first_name, $last_name, $email, $gender, $birthdate, $city)) {
        header("Location: ../participants.php");
        exit();
    }
} // <-- Closing brace for add_participant block was missing here

if (isset($_POST['delete_participant'])) {
    $participant_id = $_POST['participant_id'];
    
    if ($participant->deleteParticipant($participant_id)) {
        header("Location: ../participants.php");
        exit();
    }
}
?>