<?php
# 包含連接
require_once "./config.php";

// 接收區域和時段
$date = $_GET['date'];
$reason = $_GET['reason'];
$currentDate = date('Y-m-d');
$thirtyday = date('Y-m-d', strtotime($currentDate. ' + 30 days'));
if($currentDate <= $date){
    if($thirtyday >= $date){
        // 查询数据库以检查是否有 blockdate 匹配当前日期
    $sql = "INSERT INTO blockdate (date, reason) VALUES ('$date', '$reason');";
    if ($link->query($sql) === TRUE) {
        
    // 透過預約訂單的 rid 刪除 reservation 表中的資料
    $sql = "DELETE FROM reservation WHERE  rdate = '$date'";
    if ($link->query($sql) === TRUE) {
        echo "<div id = 'infoPopup' class='popup'>
        <p>設定成功。</p>
        <button  onclick='openBlockDatePopup()' >確認</button> 
        </div>"; 
    }
    else{
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    } else {
        echo "Error: " . $sql . "<br>" . $link->error;
    }
    }
    else{
        echo "<div id = 'infoPopup' class='popup'>
    <p>請選擇30日內的日期。</p>
    <button  onclick='openBlockDatePopup()' >確認</button>
    </div>";
    }
}else{
    echo "<div id = 'infoPopup' class='popup'>
    <p>請選擇當日或30日內的日期。</p>
    <button  onclick='openBlockDatePopup()' >確認</button>
    </div>";
}



// 关闭数据库连接
$link->close();
