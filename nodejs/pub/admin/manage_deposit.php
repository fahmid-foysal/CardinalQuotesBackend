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
                    <h4 class="text-primary">Pending Deposits</h4>
                    <!--<button class="btn btn-success" onclick="showPopup()">Upload deposit info</button>-->
                </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Method</th>
                            <th>Sender Number</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="pendingDepositTable"></tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
 <div class="modal fade" id="createEventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createEventForm">
                     <div class="mb-3">
                        <label class="form-label">Deposit Number</label>
                        <input type="text" class="form-control" id="media" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video Link</label>
                        <input type="text" class="form-control" id="link" required>
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
    
    function showPopup() {
            $('#createEventModal').modal('show');
    }
$(document).ready(fetchPendingDeposits);

function fetchPendingDeposits() { 
    $.ajax({
        url: "https://grandroombd.com/api/get_pending_deposits.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log("Full API Response:", response); // Log the response
            console.log("Type of Response:", typeof response);

            if (response && response.status === "success" && Array.isArray(response.data)) {
                updateDepositTable(response.data);
            } else {
                console.error("Unexpected API Response Structure:", response);
                $("#pendingDepositTable").html('<tr><td colspan="7">No pending deposits found.</td></tr>');
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", xhr.status, error);
            console.error("Server Response:", xhr.responseText);
            $("#pendingDepositTable").html('<tr><td colspan="7" class="text-danger">Error fetching deposits.</td></tr>');
        }
    });
}


function updateDepositTable(deposits) {
    let tableBody = $("#pendingDepositTable"); // Ensure ID matches your HTML
    tableBody.empty();

    if (!deposits || deposits.length === 0) {
        tableBody.html('<tr><td colspan="7">No pending deposits found.</td></tr>');
        return;
    }

    deposits.forEach((deposit, index) => {
        let row = `
            <tr data-deposit-id="${deposit.deposit_id}">
                <td>${index + 1}</td>
                <td>${deposit.transaction_id}</td>
                <td>${deposit.transaction_method}</td>
                <td>${deposit.sender_mobile || "N/A"}</td>
                <td>${deposit.amount}</td>
                <td><span class="badge bg-warning">Pending</span></td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="updateDepositStatus(${deposit.deposit_id}, 'approved')">Approve</button>
                    <button class="btn btn-danger btn-sm" onclick="declinedDeposit(${deposit.deposit_id}, 'declined')">Decline</button>
                </td>
            </tr>
        `;
        tableBody.append(row);
    });
}

function updateDepositStatus(depositId) {
     if (!confirm("Are you sure you want to approve this deposit?")) return;
    depositId = parseInt(depositId); // Ensure it's an integer

    $.ajax({
        url: "https://grandroombd.com/api/approve_deposite.php",
        type: "POST",
        dataType: "json",
        contentType: "application/json", // Send data as JSON
        data: JSON.stringify({ deposit_id: depositId }), // Convert to JSON format
        success: function(response) {
            console.log("Update API Response:", response);
            if (response.status === "success") {
                alert("Deposit approved successfully!");
                fetchPendingDeposits();
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating deposit:", xhr.status, error);
            console.error("Server Response:", xhr.responseText);
            alert("Failed to update deposit status.");
        }
    });
}

function declinedDeposit(depositId) {
    depositId = parseInt(depositId); // Convert to integer
    console.log("Declining Deposit ID:", depositId);

    if (!confirm("Are you sure you want to decline this deposit?")) return;

    $.ajax({
        url: "https://grandroombd.com/api/delete_deposite.php",
        type: "DELETE",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({ deposit_id: depositId }), // Send as integer
        success: function(response) {
            console.log("Update API Response:", response);
            if (response.status === "success") {
                alert("Deposit declined successfully!");
                fetchPendingDeposits(); // Refresh table
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error updating deposit:", xhr.status, error);
            console.error("Server Response:", xhr.responseText);
            alert("Failed to update deposit status.");
        }
    });
}


    </script>
</body>
</html>
