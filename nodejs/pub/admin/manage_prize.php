<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php"); // Redirect to login page
    exit;
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grandroom BD</title>
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
                        <span class="logo-text"><h3 class="text-center">Grandroom BD</h3></span>
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
                    <h4 class="text-primary">Available Prize</h4>
                    <button class="btn btn-success" onclick="showPopup()">Upload prize</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table table-bordered text-center mx-auto">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Prize Money</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="PrizeTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="uploadPrizeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Prize</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="uploadPrizeForm">
                    <div class="mb-3">
                        <label class="form-label">Select Event</label>
                        <select class="form-control" id="eventSelect" required>
                            <option value="">-- Select Event --</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prize Money</label>
                        <input type="text" class="form-control" id="prize_money" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Position</label>
                        <input type="number" class="form-control" id="position" required>
                    </div>
                  

                    <button type="submit" class="btn btn-primary">Upload Prize</button>
                </form>
            </div>
        </div>
    </div>
</div>



    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
       $(document).ready(fetchPrize);

function fetchPrize() {
    $.ajax({
        url: "https://grandroombd.com/api/get_all_prize.php",
        type: "GET",
        headers: {
            "Authorization": "Bearer YOUR_ACCESS_TOKEN" // Replace with a valid token if required
        },
        success: function (response) {
            if (response.status === "success") {
                let tableBody = $("#PrizeTableBody");
                tableBody.empty();

                let PrizeByEvent = {};
                let serialNo = 1; // Serial number counter

                // Group prizes by event_id
                response.data.forEach(prize => {
                    if (!PrizeByEvent[prize.event_id]) {
                        PrizeByEvent[prize.event_id] = {
                            event_name: prize.event_name,
                            draw_date: prize.draw_date,
                            data: []
                        };
                    }
                    PrizeByEvent[prize.event_id].data.push(prize);
                });

                // Render prizes grouped by event
                Object.keys(PrizeByEvent).forEach(eventId => {
                    let eventGroup = PrizeByEvent[eventId];

                    // Append Event Header
                    let eventHeaderRow = `
                        <tr class="table-primary">
                            <td colspan="5" class="fw-bold text-center">
                                ${eventGroup.event_name} (Draw Date: ${eventGroup.draw_date})
                            </td>
                        </tr>
                    `;
                    tableBody.append(eventHeaderRow);

                    // Append prizes for the Event
                    eventGroup.data.forEach(prize => {
                        let row = `
                            <tr data-prize-id="${prize.id}">
                                <td>${serialNo++}</td>  <!-- Serial Number Column -->
                              
                                <td>${prize.prize_money}</td>  <!-- Prize Name -->
                                 <td>${prize.position}</td>  <!-- Prize Position -->
                            
                                  <td>
                            
                                    <button class="icon-btn delete-btn" onclick="deleteRow(this)" style="color: #dc3545; border: none; background: none;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>

                            </tr>
                        `;
                        tableBody.append(row);
                    });
                });
            } else {
                console.error("API Error: " + response.message);
            }
        },
        error: function () {
            console.error("Error fetching Prize.");
        }
    });
}


    function showPopup() {
            $('#uploadPrizeModal').modal('show');
    }

$("#uploadPrizeForm").submit(function (e) {
    e.preventDefault();

    let eventId = $("#eventSelect").val();
    let prizeMoney = $("#prize_money").val().trim();
    let position = $("#position").val().trim();

    // Debugging logs
    console.log("Event ID:", eventId);
    console.log("Prize Money:", prizeMoney);
    console.log("Position:", position);

    // Validation checks
    if (!eventId || !prizeMoney || !position) {
        alert("All fields are required!");
        return;
    }

    // Ensure prizeMoney is a valid float
    prizeMoney = parseFloat(prizeMoney);
    if (isNaN(prizeMoney) || prizeMoney < 0) {
        alert("Prize money must be a valid positive number!");
        return;
    }

    let data = {
        event_id: eventId,
        prize_money: prizeMoney,
        position: position
    };

    $.ajax({
        url: "https://grandroombd.com/api/declare_prize.php",
        type: "POST",
        contentType: "application/json",  // ✅ API expects JSON
        data: JSON.stringify(data),       // ✅ Send JSON request
        success: function (response) {
            console.log("API Response:", response);

            if (response.status === "success") {
                alert("Prize uploaded successfully!");
                $("#uploadPrizeModal").modal("hide");
                fetchPrize();  // ✅ Reload the prize table
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("Failed to upload prize. Please try again.");
        }
    });
});




        function deleteRow(button) {
            let row = button.closest("tr");
            let prizeId = row.getAttribute("data-prize-id");

            if (!confirm("Are you sure you want to delete this prize ?")) return;

            $.ajax({
                url: `https://grandroombd.com/api/delete_prize.php?prize_id=${prizeId}`,
                type: "DELETE",
                success: function (response) {
                    if (response.status === "success") {
                        alert("Prize deleted successfully!");
                        row.remove();
                    }
                }
            });
        }
        $(document).ready(function () {
    $("#uploadPrizeModal").on("show.bs.modal", function () {
        fetchEvents();
    });
});

function fetchEvents() {
    $.ajax({
        url: "https://grandroombd.com/api/get_all_event.php",
        type: "GET",
        success: function (response) {
            if (response.status === "success") {
                let eventSelect = $("#eventSelect");
                eventSelect.empty().append('<option value="">-- Select Event --</option>');

                response.data.forEach(event => {
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
