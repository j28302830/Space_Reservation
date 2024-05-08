<?php

include_once './get_reservations.php'; // 包含取得預約資訊的功能程式碼
$reservations = getReservations($_SESSION["username"]);
function generateReservationTable($reservations)
{
    if (!empty($reservations)) {
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th scope='col'>編號</th>";
        echo "<th scope='col'>區域</th>";
        echo "<th scope='col'>座位編號</th>";
        echo "<th scope='col'>插座</th>";
        echo "<th scope='col'>日期</th>";
        echo "<th scope='col'>時段</th>";
        echo "<th scope='col'>預約日期時間</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($reservations as $reservation) {
            echo "<tr>";
            echo "<td>" . $reservation['編號'] . "</td>";
            echo "<td>" . $reservation['區域'] . "</td>";
            echo "<td>" . $reservation['座位編號'] . "</td>";
            echo "<td>" . $reservation['插座'] . "</td>";
            echo "<td>" . $reservation['日期'] . "</td>";
            echo "<td>" . $reservation['時段'] . "</td>";
            echo "<td>" . $reservation['預約日期時間'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>沒有找到相關資料</p>";
    }
}
// 調用函數生成預約表格並將其作為 AJAX 响應返回
echo generateReservationTable($reservations);
