<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tesla Referral Site</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('/img/teslabackground.jpg');
      background-size: cover; /* Adjusts the image to cover the entire background */
      background-repeat: no-repeat; /* Prevents background image repetition */
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
      text-align: left; /* Aligns the list items to the left */
      margin-left: 20px; /* Adds indentation for better readability */
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
      <a href="#" class="btn">Get data</a>
    </div>

    <div class="container">
      <input type="text" placeholder="Enter data...">
      <button class="btn">Send Data</button>
    </div>
  </div>

</body>
</html>
