<?php
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
}
$is_admin = $_SESSION['username'] == 'Admin' ? true : false;  
?>
<?php include 'app/views/templates/alert.php' ?>  
<!DOCTYPE html>
<html lang="en">
    <head>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="icon" href="/favicon.png">
        <title>COSC 4806</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark text-white bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">COSC 4806</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/reminders">Reminders</a>
        </li>
        <?php if ($is_admin === true): ?><li class="nav-item">
          <a class="nav-link" aria-current="page" href="/reports">Reports</a>
        </li>
        <?php endif;?>
      </ul>
      <div class="row justify-content-end" style="text-align: center;">
          <div class="col-lg-12">
              <p class="mb-0"> >><a href="/logout">Click here to logout</a><<</p>
          </div>
      </div>
    </div>
  </div>
</nav>