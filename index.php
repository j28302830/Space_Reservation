<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User login system</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="shortcut icon" href="./img/favicon-16x16.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./js/process.js"></script>
</head>

<body>
  <div>
    <header>
      <ul class="nav nav-justified">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">首頁</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="toggleTable();removediv()">查詢</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal">新增預約</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">登出</a>
        </li>
      </ul>
    </header>
  </div>

  <div id="show" class="container">
    <div class="alert alert-success my-5">
      Welcome ! You are now signed in to your account.
    </div>
    <!-- User profile -->
    <div class="row justify-content-center">
      <div class="col-lg-5 text-center">
        <img src="./img/blank-avatar.jpg" class="img-fluid rounded" alt="User avatar" width="180">
        <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>

      </div>
    </div>
  </div>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div>
            <h3>當日預約現況</h3>
            <label for="area">選擇區域:</label>
            <select id="area">
              <option value="A">區域 A</option>
              <option value="B">區域 B</option>
            </select>

            <label for="period">選擇時段:</label>
            <select id="period">
              <?php
              $startTime = strtotime("9:00");
              $endTime = strtotime("22:00");
              $period = 1;
              while ($startTime < $endTime) {
                $startTimeFormatted = date("H:i", $startTime);
                $nextHour = strtotime("+1 hour", $startTime);
                $nextHourFormatted = date("H:i", $nextHour);
                echo "<option value='$period'>$startTimeFormatted~$nextHourFormatted</option>";
                $startTime = $nextHour;
                $period++;
              }
              ?>
            </select>
            <label for="area">選擇日期:</label>
            <input type="date" id="date">
            <button onclick="loadArea()">確認</button>

            <div id="seats"></div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="getReservationInfo()">Conform</button>
        </div>

      </div>
    </div>
  </div>
  <!-- The Modal -->
  <div class="modal" id="confirmmodal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">確認是否取消預約</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal" onclick="cancel_reservation()">Confirm</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</body>

</html>