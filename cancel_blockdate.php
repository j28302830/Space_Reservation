<?php
session_start();
# 包含連接
require_once "./config.php";

// 接收區域和時段
$bid = $_GET['bid'];
$username = $_SESSION["username"];

$sql = "SELECT is_admin FROM users WHERE username = '$username'";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

    if($row['is_admin']){
        // 根據使用者名稱從 users 表中獲取 id
$sql = "SELECT id FROM users WHERE username = '$username'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["id"];

    // 透過預約訂單的 bid 刪除 blockdate 表中的資料
    $sql = "DELETE FROM blockdate WHERE  bid = '$bid'";

    if ($link->query($sql) === TRUE) {
        echo "<div id = 'infoPopup' class='popup'>
                <p>成功開放預約日期。</p>
                <button  onclick='openBlockDatePopup()' >確認</button>
            </div>";
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
} else {
    echo "未找到相符的使用者";
}
    }else{
        echo"不是管理員";
    }
    



// 關閉連接
$link->close();
