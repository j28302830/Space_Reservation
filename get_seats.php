<?php
# 包含連接
require_once "./config.php";

// 接收區域
$area = $_GET['area'];

// 從數據庫中獲取座位信息
$sql = "SELECT num FROM seats WHERE location = '$area' ORDER BY num";
$result = $link->query($sql);

// 輸出座位信息
echo "<h3>$area</h3>";
echo "<table>";
echo "<tr>";

$count = 1; // 用於計數，控制每行顯示的座位編號
while ($row = $result->fetch_assoc()) {
    echo "<td>" . $row["num"] . "</td>";
    if ($count % 4 == 0) {
        echo "</tr><tr>"; // 每四個座位換行
    }
    $count++;
}

echo "</tr>";
echo "</table>";

// 關閉數據庫連接
$link->close();
?>
