<?php
$servername = "localhost";
$username = "dklein";
$password = "*********";
$dbname = "D-Bird";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$date = $_POST['date'];
$time = $_POST['time'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$accuracy = $_POST['accuracy'];
$species = $_POST['species'];
$deadinjured = $_POST['deadinjured'];
$sex = $_POST['sex'];
$age = $_POST['age'];

$name = $_POST['name'];
$name = str_replace("'", "", $name);

$contact_info = $_POST['contact_info'];
$contact_info = str_replace("'", "", $contact_info);

$notes = $_POST['notes'];
$notes = str_replace("'", "", $notes);





$sql = "INSERT INTO Master_List (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes');";

$sql .= "INSERT INTO NYC_Audubon (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes');";





$cartodb_username = "dklein";

$api_key= "*****************";

$cartoDBsql .= "INSERT INTO d_bird(datefound,deadinjured,lati,longi,species,the_geom) VALUES('$date','$deadinjured','$latitude','$longitude','$species',ST_SetSRID(ST_MakePoint($longitude,$latitude),4326))";


//---------------
// Initializing curl
$ch = curl_init( "https://".$cartodb_username.".cartodb.com/api/v2/sql" );
$query = http_build_query(array('q'=>$cartoDBsql,'api_key'=>$api_key));
// Configuring curl options
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result_not_parsed = curl_exec($ch);
//----------------





if ($conn->multi_query($sql) === TRUE) {
    header("Location:http://d-bird.org/thank%20you.html");

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
