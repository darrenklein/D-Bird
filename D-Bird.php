<?php


    $target_dir = "uploads/";
    
    $file = $_FILES["fileToUpload"]["name"];
    
    $mobi_file = $_FILES["fileToUploadMobile"]["name"];
    

   
  
    
    if ($file){
        //ADDED RANDOM NUMBER METHOD TO ENSURE GENERATION OF UNIQUE URL FOR EACH PHOTO
    	$target_file = (strtolower($target_dir . rand(1, 9999999) . basename($_FILES["fileToUpload"]["name"])));
        $target_file = str_replace(" ", "", $target_file);
    	$uploadOk = 1;
    	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    	
    	// Check if file already exists
    	if (file_exists($target_file)) {
        $target_file = (strtolower($target_dir . rand(1, 9999999) . basename($_FILES["fileToUpload"]["name"])));
        $target_file = str_replace(" ", "", $target_file);
    	};
    	
    	    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "tif" && $imageFileType != "tiff") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, TIF, & TIFF files are allowed. Please return to the form and try again.";
        $uploadOk = 0;
    }




    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } 

    else {

        //MOVES IMAGE TO DIRECTORY, INITIATES INSERTION INTO MYSQL/CARTODB
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    
       
            $servername = "localhost";
            $username = "*****";
            $password = "*******";
            $dbname = "******";

            $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    } 


            //TO MYSQL
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


         $sql = "INSERT INTO Master_List (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes, upload_url, source)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes', 'http://www.d-bird.org/$target_file', 'nyc audubon');";

$sql .= "INSERT INTO NYC_Audubon (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes, upload_url)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes', 'http://www.d-bird.org/$target_file');";








$cartodb_username = "dklein";

$api_key= "819b0c5916868603c2cd39fbf7e32c7590224a21";

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


            
    } 
    else {
        echo "Sorry, there was an error.  Please try again.";
    }
}
    
    }
    
    
    
    
    
    
    
    
    
    else if ($mobi_file){
    	//ADDED RANDOM NUMBER METHOD TO ENSURE GENERATION OF UNIQUE URL FOR EACH PHOTO
    	$target_file = (strtolower($target_dir . rand(1, 9999999) . basename($_FILES["fileToUploadMobile"]["name"])));
        $target_file = str_replace(" ", "", $target_file);
    	$uploadOk = 1;
    	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    	
    	// Check if file already exists
    	if (file_exists($target_file)) {
        $target_file = (strtolower($target_dir . rand(1, 9999999) . basename($_FILES["fileToUploadMobile"]["name"])));
        $target_file = str_replace(" ", "", $target_file);
    	};
    	
    	    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "tif" && $imageFileType != "tiff") {
        echo "Sorry, only JPG, JPEG, PNG, GIF, TIF, & TIFF files are allowed. Please return to the form and try again.";
        $uploadOk = 0;
    }




    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } 

    else {

        //MOVES IMAGE TO DIRECTORY, INITIATES INSERTION INTO MYSQL/CARTODB
        if (move_uploaded_file($_FILES["fileToUploadMobile"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    
       
            $servername = "localhost";
            $username = "*****";
            $password = "*******";
            $dbname = "******";

            $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    } 


            //TO MYSQL
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


         $sql = "INSERT INTO Master_List (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes, upload_url, source)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes', 'http://www.d-bird.org/$target_file', 'nyc audubon');";

$sql .= "INSERT INTO NYC_Audubon (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes, upload_url)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes', 'http://www.d-bird.org/$target_file');";








$cartodb_username = "dklein";

$api_key= "819b0c5916868603c2cd39fbf7e32c7590224a21";

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


            
    } 
    else {
        echo "Sorry, there was an error.  Please try again.";
    }
}
}










    else{
            $servername = "localhost";
            $username = "****";
            $password = "******";
            $dbname = "*****";

            $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    } 

	

            //TO MYSQL
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



         $sql = "INSERT INTO Master_List (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes, source)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes', 'nyc audubon');";

$sql .= "INSERT INTO NYC_Audubon (date, time, latitude, longitude, accuracy, species, deadinjured, sex, age, name, contact_info, notes)
VALUES ('$date', '$time', '$latitude', '$longitude', '$accuracy', '$species', '$deadinjured', '$sex', '$age', '$name', '$contact_info', '$notes');";








$cartodb_username = "dklein";
$api_key= "819b0c5916868603c2cd39fbf7e32c7590224a21";

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
                } 
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
    
};
    


?>