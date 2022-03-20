<?php

class Hospital {
    public $facility_name;
    public $city;
    public $state;
    public $main_phone;
    public $main_fax;
    public $film_phone;
    public $film_fax;
    public $procedures;
    public $push_capability;
    public $notes;
}

include_once ("./connect.php");
$sql = "SELECT `facility_name`, `city`, `state`, `main_phone`, `main_fax`, `film_phone`, `film_fax`, `procedures`, `push_capability`, `notes` FROM onydex";

$resultset = mysqli_query($cnxn, $sql) or die("database error:".mysqli_error($cnxn));

$hospitals = array();
while($record = mysqli_fetch_assoc($resultset)) {
    $hospital = new Hospital();
    $hospital->facility_name = $record['facility_name'];
    $hospital->city = $record['city'];
    $hospital->state = $record['state'];
    $hospital->main_phone = $record['main_phone'];
    $hospital->main_fax = $record['main_fax'];
    $hospital->film_phone = $record['film_phone'];
    $hospital->film_fax = $record['film_fax'];
    $hospital->procedures = $record['procedures'];
    $hospital->push_capability = $record['push_capability'];
    $hospital->notes = $record['notes'];

    array_push($hospitals, $hospital);
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($hospitals);
?>