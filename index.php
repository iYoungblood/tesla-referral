<?php

require_once('vendor.php');
(new DotEnv(__DIR__.'/.env'))->load();

// Database configuration
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_password = getenv('DB_PASSWORD');
$db_name = getenv('DB_NAME');

// Create a secure database connection
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check the connection
if($connection->connect_error) {
  die("Connection failed: ".$connection->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Tesla Referral Site</title>
  <meta name="description" content="Get a Tesla Referral Link to save on your next Tesla">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel=“canonical” href="https://s3xyreferral.com" />


  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('/img/teslabackground.jpg');
      background-size: cover;
      /* Adjusts the image to cover the entire background */
      background-repeat: no-repeat;
      /* Prevents background image repetition */
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      /* height: 100vh; */
    }

    header {
      background-color: #333;
      color: #fff;
      width: 100%;
      text-align: center;
      padding: 10px 0;
    }

    nav {
      background-color: #444;
      padding: 10px 0;
      width: 100%;
      text-align: center;
    }

    nav a {
      text-decoration: none;
      color: #fff;
      padding: 5px 10px;
      margin: 0 10px;
    }

    .content {
      text-align: center;
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .container {
      background-color: #eee;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      margin-bottom: 20px;
      width: 600px;
    }

    .container input[type="text"] {
      width: calc(100% - 22px);
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
      text-align: center;
      /* Center-align the text */
    }

    .btn {
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      background-color: #333;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #555;
    }

    .container ul {
      text-align: left;
      /* Aligns the list items to the left */
      margin-left: 20px;
      /* Adds indentation for better readability */
    }

    .error {
      color: red;
    }
  </style>
</head>

<body>

  <header>
    <h1>Tesla Referral Site</h1>
  </header>

  <nav>
    <a href="faq.html">FAQ</a>
  </nav>

  <div class="content">
    <div class="container">
      <h2>Looking for a referral link to buy a new Tesla or Tesla Solar? Click the button below to get one.<br>
        Current discount offers are:</h2>
      <ul>
        <li>Model S/X: 3 months of Full Self-Driving</li>
        <li>Model 3/Y: 6 Months Super Charging, 3 Months FSD</li>
        <li>Solar Roof: $500 off</li>
        <li>Solar Panels: $500 off</li>
      </ul>
      <form id="getForm" action="/" method="post">
        <button id="getLinkButton" type="submit" class="btn" name="getlink">Get Referral Link</button>
      </form>
      <div class="returnedLinkContainer"
        style="display: none; background-color: #f0f5fc; padding: 10px; border-radius: 8px; margin-top: 20px;">
        <h3>Referral Link:</h3>
        <p id="randomLink"></p>
        <?php
          if(isset($_POST['getlink'])) {
            $query = "SELECT teslalink FROM s3xy ORDER BY RAND() LIMIT 1";
            $result = $connection->query($query);

            if($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo $row['teslalink'];
              // Add an indicator for JavaScript to display the container
              echo '<script>document.querySelector(".returnedLinkContainer").style.display = "block";</script>';
            } else {
              echo "No data found";
            }
          }
          ?>
        <button id="copyButton" class="btn" onclick="copyToClipboard()" style="display: none;">Copy to
          Clipboard</button>
      </div>
    </div>

    <div class="container">
      <h3>Already own a Tesla? Submit your referral link into the database below.</h3>
      <form id="teslaForm" action="/" method="post">
        <input id="teslaLinkInput" type="text" name="tesla_link" placeholder="https://ts.la/yourlink">
        <span id="errorMessage" class="error" style="display: none;">Incorrect format</span>
        <button type="submit" class="btn" name="submit" onclick="return validateLink()">Send Data</button>


      </form>
      <h3>
        <?php
        // Check if form is submitted
        if(isset($_POST['submit'])) {
          $teslaLink = $_POST['tesla_link'];

          // SQL query to check if the entry exists in the database
          $query = "SELECT * FROM s3xy WHERE teslalink = '$teslaLink'";
          $result = $connection->query($query);

          if($result->num_rows > 0) {
            // Entry exists in the database
            echo "Entry already exists!";
          } else {
            // Entry does not exist in the database, insert a new entry
            $currentDateTime = date('Y-m-d H:i:s'); // Current datetime
        
            // SQL query to insert a new entry
            $insertQuery = "INSERT INTO s3xy (submitted, teslalink, active) VALUES ('$currentDateTime', '$teslaLink', '1')";

            if($connection->query($insertQuery) === TRUE) {
              echo "Your referral code has been added successfully!";
            } else {
              echo "Error: ".$insertQuery."<br>".$connection->error;
            }
          }
        }
        ?>
      </h3>

    </div>
  </div>

  <script>

    
    function copyToClipboard() {
      const linkToCopy = document.getElementById('randomLink').textContent;

      // Create a temporary textarea element to copy the text
      const tempTextarea = document.createElement('textarea');
      tempTextarea.value = linkToCopy;
      document.body.appendChild(tempTextarea);

      // Select and copy the text from the textarea
      tempTextarea.select();
      document.execCommand('copy');

      // Clean up and remove the temporary textarea
      document.body.removeChild(tempTextarea);
    }


    function validateLink() {
      // Get the value entered in the textbox
      const teslaLink = document.getElementById('teslaLinkInput').value;
      // Check if the link starts with "https://ts.la/"
      if (!teslaLink.startsWith('https://ts.la/')) {
        // If not, show the error message and prevent form submission
        document.getElementById('errorMessage').style.display = 'inline';
        return false; // Prevent form submission
      }
      return true; // Allow form submission if the link is in the correct format
    }
    // Ensure the code is executed after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function () {
      const randomLink = document.getElementById('randomLink').textContent;
      if (randomLink !== '') {
        document.getElementById('copyButton').style.display = 'inline-block';
      }
    });
  </script>

</body>

</html>