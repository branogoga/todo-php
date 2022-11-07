<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Hello, Dockerized PHP!</title>
  </head>
  <body>
    <?php
      echo "<h1>Hello, Dockerized PHP!";
    ?>
    <?php
      $host = 'db';
      $user = 'app_user';
      $pass = 't3rceS';
      $conn = new mysqli($host, $user, $pass);
      if ($conn->connect_error) {
          die("<h2>Connection failed: " . $conn->connect_error."</h2>");
      } else {
          echo "<h2>Connected to MySQL server successfully!</h2>";
      }      
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
  </body>
</html>