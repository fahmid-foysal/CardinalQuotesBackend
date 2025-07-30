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
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-ticket"></i><span class="hide-menu">Manage Cupon</span></a></li>
                       <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Manage Deposit</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="result.php" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Publish Result</span></a></li>   
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="create_event.php" aria-expanded="false"><i class="mdi mdi-arrow-all"></i><span class="hide-menu">Create Event</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-link"></i><span class="hide-menu">Manage Live</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Manage sold coupon</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-calendar-check"></i><span class="hide-menu">Manage Prize</span></a></li>
                       
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
            <button class="btn btn-success" onclick="showPopup()">Upload deposit info</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Number</th>
                        <th>Video Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="pendingDepositTable"></tbody>
            </table>
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
                    <textarea class="form-control" id="phone_number" rows="4" required></textarea>
                </div>

                        <div class="mb-3">
                            <label class="form-label">Video Link</label>
                            <input type="text" class="form-control" id="tut_link" required>
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
    
function fetchPendingDeposits() {
    $.get("https://www.lotterybdt.com/api/get_number.php", function(response) {
        console.log("API Response:", response); // Debugging

        let tableBody = "";

        if (!response || !response.data || !Array.isArray(response.data) || response.data.length === 0) {
            tableBody = `<tr><td colspan="4" class="text-center text-muted">No numbers available</td></tr>`;
        } else {
            response.data.forEach((item, index) => {
                tableBody += `<tr>
                    <td>${index + 1}</td>
                    <td>${item.phone_number}</td>
                    <td><a href="${item.tut_link}" target="_blank">View</a></td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteNumber(${item.id})">Delete</button></td>
                </tr>`;
            });
        }

        $("#pendingDepositTable").html(tableBody);
    }, "json").fail(function(xhr, status, error) {
        console.error("Error:", error);
        console.error("Response:", xhr.responseText);
        $("#pendingDepositTable").html(`<tr><td colspan="4" class="text-center text-danger">Failed to load data</td></tr>`);
    });
}



        function showPopup() {
            $('#createEventModal').modal('show');
        }

  $("#createEventForm").submit(function (e) {
    e.preventDefault();

    let resultData = {
        phone_number: $("#phone_number").val().trim(),
        tut_link: $("#tut_link").val().trim()
    };

    // Debugging: Log data before sending
    console.log("Submitting Data:", resultData);

    if (!resultData.phone_number || !resultData.tut_link) {
        alert("Phone number and tutorial link are required!");
        return;
    }

    $.ajax({
        url: "https://www.lotterybdt.com/api/upload_number.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(resultData),
        success: function (response) {
            console.log("Server Response:", response); // Debugging server response
            if (response.status === "success") {
                alert("Number uploaded successfully!");
                $("#createEventModal").modal("hide");
                fetchPendingDeposits();  // ✅ Reload the deposit table
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error:", error);
            console.error("Response:", xhr.responseText);
            alert("Failed to upload number.");
        }
    });
});

        function deleteNumber(id) {
            if (confirm("Are you sure you want to delete this number?")) {
                $.ajax({
                    url: `https://www.lotterybdt.com/api/delete_number.php?id=${id}`,
                    type: "DELETE",
                    success: function(response) {
                        alert(response.message);
                        fetchPendingDeposits();
                    },
                    dataType: "json"
                });
            }
        }

        $(document).ready(fetchPendingDeposits);




    </script>
</body>
</html>
