<?php
session_start();
# 包含連接
require_once "./config.php";

// 接收區域和時段
$rid = $_GET['rid'];
$username = $_SESSION["username"];


// 根據使用者名稱從 users 表中獲取 id
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];

    // 根據使用者 id 和預約訂單的 rid 刪除 reservation 表中的資料
    $sql = "DELETE FROM reservation WHERE id = '$userId' AND rid = '$rid'";

    if ($link->query($sql) === TRUE) {
        echo "<div id = 'infoPopup' class='popup'>
                <p>成功刪除預約訂單。</p>
                <button  onclick='removeInfoPopup()' >確認</button>
            </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
} else {
    echo "未找到相符的使用者";
}

// 關閉連接
$link->close();
