<?php
# 包含連接
require_once "./config.php";

// 接收區域和時段
$area = $_GET['area'];
$date = $_GET['date'];
$period = $_GET['period'];
// 获取当天日期
$currentDate = $date;

// 查询数据库以检查是否有 blockdate 匹配当前日期
$sql = "SELECT reason FROM blockdate WHERE date = '$currentDate'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // 输出 blockdate 的原因
    while($row = $result->fetch_assoc()) {
        echo "不可預約的原因是: " . $row["reason"];
    }
} else {
    // 从数据库中获取座位信息
$sql = "SELECT num, sid FROM seats WHERE location = '$area'";
$result = $link->query($sql);

// 生成座位信息
$seats = array();
while ($row = $result->fetch_assoc()) {
    $seats[$row['sid']] = $row['num'];
}



// 从预约表中获取预约信息
$sql = "SELECT sid FROM reservation WHERE rdate = '$currentDate' AND pid = $period";
$result = $link->query($sql);

// 生成预约座位列表
$reservedSeats = array();
while ($row = $result->fetch_assoc()) {
    $reservedSeats[] = $row['sid'];
}

// 输出座位信息
echo "<h3>$area</h3>";
echo "<table>";

$count = 0; // 用于计数，控制每行显示的座位数量
foreach ($seats as $sid => $num) {
    if ($count % 5 == 0) {
        echo "<tr>";
    }

    // 检查座位是否已被预约
    if (in_array($sid, $reservedSeats)) {
        echo "<td style='background-color: red'>$num</td>";
    } else {
        echo "<td><button style='background-color: green' onclick='selectButton($num)'>$num</button></td>";
    }

    $count++;

    if ($count % 5 == 0) {
        echo "</tr>";
    }
}

echo "</table>";

}


// 关闭数据库连接
$link->close();
