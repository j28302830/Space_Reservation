<?php
session_start();
    require_once "./config.php";

    $username = $_SESSION["username"];

$sql = "SELECT is_admin FROM users WHERE username = '$username'";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();

    if($row['is_admin']){
        // 查询数据库以获取 blockdate 表中的所有记录
    $sql = "SELECT bid, date, reason FROM blockdate";
    $result = $link->query($sql);

    // 输出每一行的数据
    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo 
        "
        <tr>
        <th>編號</th>
        <th>不開放日期</th>
        <th>原因</th>
        <th>開放預約</th>
        </tr>
        ";
        $count=1;
        while($row = $result->fetch_assoc()) {
            //print_r($row);
            echo "<tr>";
            echo "<td>" . $count++ . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["reason"] . "</td>";
            echo "<td> <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#confirmmodal' onclick='recordopenbid(".$row["bid"].")'> 開放 </button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<tr><td colspan='3'>没有 block dates。</td></tr>";
    }
    }
    else{

    }
    

    // 关闭数据库连接
    $link->close();
?>