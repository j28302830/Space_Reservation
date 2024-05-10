function showPeriod() {
    var area = document.getElementById("area").value;
    var period = document.getElementById("period").value;
    showArea(area, period);
}

function showArea(area, period) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("seats").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_seats.php?area=" + area + "&period=" + period, true);
    xmlhttp.send();
}

function removediv() {
    const element = document.getElementById("show");
    element.innerHTML = "";
}

function toggleTable() {
    removediv();
    var tableDiv = document.getElementById("show");

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "reservation_table.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            tableDiv.innerHTML = '<h2 class="my-4">預約資訊</h2>' + xhr.responseText;
        }
    };
    xhr.send();

}


function loadArea() {
    var date = document.getElementById('date').value;
    var area = document.getElementById("area").value;
    var period = document.getElementById("period").value;
    loadSeats(area, period, date);
    // AJAX request to fetch seat availability based on date and time
    // Update seat buttons accordingly
}

function loadSeats(area, period, date) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("seats").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_seatbutton.php?area=" + area + "&period=" + period + "&date=" + date, true);
    xmlhttp.send();
}

var nums = null;

function selectButton(num) {
    nums = num;
}

function getReservationInfo() {

    var area = document.getElementById("area").value;
    var period = document.getElementById("period").value;
    var date = document.getElementById('date').value;
    removediv();
    sendReservation(area, period, nums, date);
}

function sendReservation(area, period, num, date) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "send_reservation.php?area=" + area + "&period=" + period + "&date=" + date + "&num=" + num, true);
    xmlhttp.send();
}

function cancel_reservation() {
    var rid = document.getElementById("cancelreservationrid").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

        }
    };
    xmlhttp.open("GET", "cancel_reservation.php?rid=" + rid, true);
    xmlhttp.send();

    removediv();
    toggleTable();
}

function removeInfoPopup() {
    const element = document.getElementById("infoPopup");
    element.remove();
    removediv();
    toggleTable();
}

function setBlockDate(){
    var date = document.getElementById('date').value;
    var reason = document.getElementById('reason').value;
    var xmlhttp = new XMLHttpRequest();
    removediv();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("show").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "set_blockdate.php?date=" + date + "&reason=" + reason, true);
    xmlhttp.send();
}