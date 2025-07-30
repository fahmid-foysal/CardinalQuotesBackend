<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lottery Bdt - Winner Results</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="index.html">
                        <span class="logo-text"><h3 class="text-center">Lottery Bdt</h3></span>
                    </a>
                </div>
            </nav>
        </header>
         <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="sold_coupon.php" aria-expanded="false"><i class="mdi mdi-ticket"></i><span class="hide-menu">Manage join Event</span></a></li>
                       <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage_deposit.php" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Manage Deposit</span></a></li>
                        <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="result.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Publish Result</span></a></li>   -->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="create_event.php" aria-expanded="false"><i class="mdi mdi-arrow-all"></i><span class="hide-menu">Create Event</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage_announce.php" aria-expanded="false"><i class="mdi mdi-speaker"></i><span class="hide-menu">Annnouncement</span></a></li>
                         <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage_deposit_info.php" aria-expanded="false"><i class="mdi mdi-play"></i><span class="hide-menu">Manage deposit info</span></a></li>-->
                        <!--<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Manage sold coupon</span></a></li>-->
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage_prize.php" aria-expanded="false"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Manage Prize</span></a></li>
                       
                        <li class="sidebar-item"> 
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#" onclick="logout(); return false;" aria-expanded="false">
                            <i class="mdi mdi-logout"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                        </li>

                      
                    
                       
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper bg-white">
            <div class="container mt-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-primary">Winner Results</h4>
                    <button class="btn btn-success" onclick="showPopup()">Publish New Result</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table table-bordered text-center mx-auto">
                        <thead class="thead-dark">
                            <tr>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Coupon No</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="ResultTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

 <div class="modal fade" id="createEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Publish Winner Result</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                    <div class="mb-3">
                        <label class="form-label">Select Event</label>
                        <select class="form-control" id="eventSelect" required>
                            <option value="">-- Select Event --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Winner Name</label>
                        <input type="text" class="form-control" id="winnerName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mobile No</label>
                        <input type="number" class="form-control" id="mobileNo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Coupon No</label>
                        <input type="number" class="form-control" id="couponNo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(fetchWinners);

function fetchWinners() {
    $.ajax({
        url: "https://www.lotterybdt.com/api/get_result.php",
        type: "GET",
        success: function (response) {
            let tableBody = $("#ResultTableBody");
            tableBody.empty();

            if (response.status === "success" && response.data.length > 0) {
                let winnersByEvent = {};

                // Group winners by event_id
                response.data.forEach(winner => {
                    if (!winnersByEvent[winner.event_id]) {
                        winnersByEvent[winner.event_id] = {
                            event_name: winner.event_name, // Event name included in API
                            winners: []
                        };
                    }
                    winnersByEvent[winner.event_id].winners.push(winner);
                });

                // Render winners grouped by event
                Object.keys(winnersByEvent).forEach(eventId => {
                    let eventGroup = winnersByEvent[eventId];

                    // Append Event Header Row
                    let eventHeaderRow = `
                        <tr class="table-primary">
                            <td colspan="5" class="fw-bold text-center">${eventGroup.event_name}</td>
                        </tr>
                    `;
                    tableBody.append(eventHeaderRow);

                    // Append Winner Rows
                    eventGroup.winners.forEach(winner => {
                        let row = `
                            <tr data-winner-id="${winner.id}">
                                <td>${winner.name}</td>
                                <td>${winner.phone_number}</td>
                                <td>${winner.coupon_num}</td>
                                <td>${winner.position}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
                                </td>
                            </tr>
                        `;
                        tableBody.append(row);
                    });
                });
            } else {
                // Display No Winners Message
                tableBody.append(`
                    <tr>
                        <td colspan="5" class="text-center text-muted">No winners found.</td>
                    </tr>
                `);
            }
        },
        error: function () {
            console.error("Error fetching winners.");
            let tableBody = $("#ResultTableBody");
            tableBody.empty().append(`
                <tr>
                    <td colspan="5" class="text-center text-danger">Failed to fetch winners. Please try again.</td>
                </tr>
            `);
        }
    });
}


        function showPopup() {
            $('#createEventModal').modal('show');
        }

   $("#createEventForm").submit(function (e) {
    e.preventDefault();

    let resultData = {
        name: $("#winnerName").val().trim(),
        phone_number: $("#mobileNo").val(),
        coupon_num: $("#couponNo").val(),
        position: $("#position").val(),
        event_id: $("#eventSelect").val()
    };

    $.ajax({
        url: "https://www.lotterybdt.com/api/publish_winner.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(resultData),
        success: function (response) {
            if (response.status === "success") {
                alert("Winner result published successfully!");
                $("#createEventModal").modal("hide");
                fetchWinners();  // ✅ Reload the winners table
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function () {
            alert("Failed to publish winner.");
        }
    });
});


   function deleteRow(button) {
    let row = button.closest("tr");
    let winnerId = row.getAttribute("data-winner-id");

    console.log("Attempting to delete Winner ID:", winnerId); // Debugging

    if (!winnerId || isNaN(winnerId) || winnerId <= 0) {
        alert("Error: Invalid Winner ID!"); // Debugging
        return;
    }

    if (!confirm("Are you sure you want to delete this winner result?")) return;

    $.ajax({
        url: `https://www.lotterybdt.com/api/delete_winner.php?winner_id=${winnerId}`,
        type: "DELETE",
        success: function (response) {
            console.log("Delete Response:", response); // Debugging

            if (response.status === "success") {
                alert("Winner result deleted successfully!");
                row.remove();
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", {
                status: xhr.status,
                statusText: xhr.statusText,
                responseText: xhr.responseText,
                errorThrown: error
            });
            alert("Failed to delete winner result. Please try again.");
        }
    });
}


        $(document).ready(function () {
    $("#createEventModal").on("show.bs.modal", function () {
        fetchEvents();
    });
});

function fetchEvents() {
    $.ajax({
        url: "https://www.lotterybdt.com/api/get_all_event.php",
        type: "GET",
        success: function (response) {
            if (response.status === "success") {
                let eventSelect = $("#eventSelect");
                eventSelect.empty().append('<option value="">-- Select Event --</option>');

                response.events.forEach(event => {
                    eventSelect.append(`<option value="${event.id}">${event.event_name}</option>`);
                });
            }
        },
        error: function () {
            console.error("Error fetching events.");
        }
    });
}

    </script>
</body>
</html>
