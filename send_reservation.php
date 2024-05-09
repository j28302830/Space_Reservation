<?php
session_start();
# 包含連接
require_once "./config.php";

// 接收區域和時段
$area = $_GET['area'];
$date = $_GET['date'];
$period = $_GET['period'];
$seat = $_GET['num'];
$username = $_SESSION["username"];

// 檢查使用者是否已經在相同日期和時段預約了座位
$sql = "SELECT r.id 
        FROM reservation r 
        INNER JOIN users u ON r.id = u.id 
        WHERE u.username = '$username' AND r.rdate = '$date' AND r.pid = '$period'";

$result = $link->query($sql);

if ($result->num_rows > 0) {
    echo "您已在相同日期和時段預約了座位，無法重複預約。";
} else {
    // 根據使用者名稱從 users 表中獲取 id
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = $link->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["id"];

        // 根據區域和座位數量從 seats 表中找到對應的 sid
        $sql = "SELECT sid FROM seats WHERE location = '$area' AND num = '$seat'";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sid = $row["sid"];

            // 插入到 reservation 表中
            $sql = "INSERT INTO reservation (id, sid, pid, rdate) VALUES ('$userId', '$sid', '$period', '$date')";

            if ($link->query($sql) === TRUE) {
                echo "預訂成功";
            } else {
                echo "Error: " . $sql . "<br>" . $link->error;
            }
        } else {
            echo "未找到相符的座位";
        }
    } else {
        echo "未找到相符的使用者";
    }
}

// 關閉連接
$link->close();
