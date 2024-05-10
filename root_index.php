<?php
# Initialize the session
session_start();
# Include connection
require_once "./config.php";

$username = $_SESSION["username"];
// 在数据库中查询用户
$sql = "SELECT is_admin FROM users WHERE username = '$username'";
$result = $link->query($sql);
$row = $result->fetch_assoc();
# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}elseif(!$row['is_admin']){
  echo "<script>" . "window.location.href='./index.php';" . "</script>";
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
          <a class="nav-link" onclick="toggleTable()">查詢</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="getBlockDateList()">維護</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#myModal">不開放借用日期設定</a>
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
          <h4 class="modal-title">設定不開放借用日期</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div>
            <label for="area">選擇日期:</label>
            <input type="date" id="date">
          </div>
          <div>
            <label for="message">輸入不開放原因：</label><br>
            <textarea id="reason" name="message" rows="4" cols="50"></textarea><br>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="setBlockDate()">Confirm</button>
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
          <h4 class="modal-title">確認是否開放預約</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn" data-bs-dismiss="modal" onclick="cancel_blockdate()">Confirm</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  
</body>

</html>