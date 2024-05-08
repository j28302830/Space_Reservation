function showPeriod() {
    var area = document.getElementById("area").value;
    var period = document.getElementById("period").value;
    showArea(area, period);
}

function showArea(area, period) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("seats").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "get_seats.php?area=" + area + "&period=" + period, true);
    xmlhttp.send();
}

function removediv(){
    const element = document.getElementById("show");
    element.remove();
}

function toggleTable() {
    var tableDiv = document.getElementById("reservationTable");

      var xhr = new XMLHttpRequest();
      xhr.open("GET", "reservation_table.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          tableDiv.innerHTML = xhr.responseText;
        }
      };
      xhr.send();

  }
