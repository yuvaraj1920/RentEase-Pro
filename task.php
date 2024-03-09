<?php
$ch = curl_init();
$url = "https://www.youtube.com/"; // The URL of the website

// Set the options for the curl request
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the curl request
$response = curl_exec($ch);

// Checking for errors in the curl request
if(curl_errno($ch)){
    // Handle the error here
    echo 'Curl Error: ' . curl_error($ch);
} else {
    // Closing the curl session
    curl_close($ch);

    // Extracting the title using regular expression
    preg_match("/<title>(.*?)<\/title>/i", $response, $matches);
    $title = $matches[1];

    // Connect to MySQL database
    $servername = "localhost"; // Replace with the server name
    $username = "root"; // Replace with your MySQL username
    $password = "Ganesh@7081"; // Replace with your MySQL password
    $dbname = "task"; // Replace with your database name (database name may vary)

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        // Handle the MySQL connection error here
        echo 'MySQL Connection Error: ' . $conn->connect_error;
    } else {
        // Save the URL and title to MySQL database
        $sql_query1 = "SELECT * FROM websites WHERE title = '$title'";

        $response = mysqli_query($conn, $sql_query1);
         if($response){
            if(mysqli_num_rows($response) > 0){
                echo "Given website already exist";
            }
        else{
        $sql_query2 = "INSERT INTO websites (url, title) VALUES ('$url', '$title')";

        if ($conn->query($sql_query2) === true) {
            echo "Website data saved successfully!";
        } else {
            // Handle the MySQL query error here
            echo "MySQL Error: " . $sql_query2 . "<br>" . $conn->error;
        }

        } // Close the database connection
      }
    }
        $conn->close();
    }
?>
