function openModal(uid) {
  var data = uid;
  document.getElementById("modal").classList.remove("hidden");

  // Make AJAX request to retrieve course data
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // Update modal content with retrieved data
      document.getElementById("modal-content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "get_courses.php?data=" + data, true);
  xhttp.send();
}

function closeModal() {
  document.getElementById("modal").classList.add("hidden");
}

function lock(uid) {
  var id = uid;
  const st = "lock";

  // Use jQuery for AJAX request
  $.ajax({
    url: "lockStatus.php",
    data: {
      id: id,
      st: st,
    },
    type: "GET",
    success: function (response) {
      // Update modal content with retrieved data
      document.getElementById("status").innerHTML = "Locked";
      document.getElementById("status").style.backgroundColor = "red";
      window.location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
    },
  });
}

$(document).ready(function () {
  // Add a click event listener to the button with ID status
  $("#status").click(function () {
    // Send an AJAX request to the server
    $.ajax({
      url: "re.php",
      type: "GET",
      dataType: "html", // changed from 'json' to 'html'
      success: function (data) {
        // Update the content of the div with the new data
        $("#upTable1").html(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(errorThrown);
      },
    });
  });
});

function unlock(uid) {
  var id = uid;
  const st = "unlock";
  
  // Use jQuery for AJAX request
  $.ajax({
    url: "lockStatus.php",
    data: {
      id: id,
      st: st,
    },
    type: "GET",
    success: function (response) {
      // Update modal content with retrieved data
      document.getElementById("status").innerHTML = "Unlocked";
      document.getElementById("status").style.background = "green";
      window.location.reload();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
    },
  });
}

// Remove duplicate function lock_check

// Remove commented out code
