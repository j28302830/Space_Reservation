<?php
session_start();

function getReservations($username)
{
    # Include connection
    require_once "./config.php";
    $reservations = array();

    $sql = "SELECT 
                ROW_NUMBER() OVER (ORDER BY r.rdatetime) AS 編號,
                s.location AS 區域,
                s.num AS 座位編號,
                CASE WHEN s.socket = 1 THEN '有' ELSE '無' END AS 插座,
                r.rdate AS 日期,
                p.time AS 時段,
                r.rdatetime AS 預約日期時間
            FROM 
                reservation r
            JOIN 
                users u ON r.id = u.id
            JOIN 
                seats s ON r.sid = s.sid
            JOIN 
                period p ON r.pid = p.pid
            WHERE 
                u.username = '$username'";

    $result = mysqli_query($link, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $reservations[] = $row;
        }
    }

    mysqli_free_result($result);
    # Close connection
    mysqli_close($link);

    return $reservations;
}
