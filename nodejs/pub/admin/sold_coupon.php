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
    <!-- jsPDF & AutoTable for PDF generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="navbar-brand" href="index.html">
                        <h3 class="text-center p-t-20 p-b-20">Grandroom BD</h3>
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
                <h4 class="text-primary">All Join User</h4>
                <div class="mb-3">
                <div class="d-flex justify-content-between mb-3">
             <div class="input-group" style="max-width: 300px;">
                <span class="input-group-text bg-primary text-white"><i class="mdi mdi-magnify"></i></span>
                <input type="text" id="searchGamerId" class="form-control border-primary shadow-sm" placeholder="Search by Game Id..." onkeyup="searchByGamerId()">
            </div>
            <button class="btn btn-success" id="generatePDF">Generate PDF</button>
        </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>game
                                <th>event_name</th>
                                <th>gamer_id</th>
                                <th>Buyer Name</th>
                                <th>Phone Number</th>
                                <th>start_date</th>
                                <th>game type</th>
                             
                            </tr>
                        </thead>
                        <tbody id="eventTableBody">
                            <!-- Dynamic content will be inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
       let allSoldEvents = [];

    $(document).ready(function () {
        fetchSoldEvent();
        $("#generatePDF").click(function () {
            generatePDF("All Sold Events", allSoldEvents);
        });
    });

    function fetchSoldEvent() {
        $.ajax({
            url: "https://grandroombd.com/api/get_all_sold_details.php", // Updated API URL
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log("API Response:", response);

                if (response.status === "success" && Array.isArray(response.events)) {
                    allSoldEvents = response.events;
                    groupAndDisplayEvents(response.events);
                } else {
                    console.error("Unexpected API Response:", response);
                    $("#eventTableBody").html('<tr><td colspan="6" class="text-danger">No sold events found.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.status, error);
                console.error("Server Response:", xhr.responseText);
                $("#eventTableBody").html('<tr><td colspan="6" class="text-danger">Error fetching sold events.</td></tr>');
            }
        });
    }

    function groupAndDisplayEvents(events) {
        let tableBody = $("#eventTableBody");
        tableBody.empty();

        if (events.length === 0) {
            tableBody.html('<tr><td colspan="6">No sold events found.</td></tr>');
            return;
        }

        // Grouping events by game type
        let groupedEvents = {};
        events.forEach(event => {
            if (!groupedEvents[event.game]) {
                groupedEvents[event.game] = [];
            }
            groupedEvents[event.game].push(event);
        });

        // Rendering grouped events
        for (const gameType in groupedEvents) {
            let gameEvents = groupedEvents[gameType];

            // Adding a section header for each game type
            let gameHeader = `
                <tr class="table-primary">
                    <td colspan="6"><strong>${gameType}</strong></td>
                </tr>
            `;
            tableBody.append(gameHeader);

            // Rendering each event inside the grouped section
            gameEvents.forEach(event => {
                let row = `
                    <tr>
                        <td>${event.event_name}</td>
                        <td>${event.gamer_id ? event.gamer_id : "N/A"}</td>
                        <td>${event.name}</td>
                        <td>${event.phone}</td>
                        <td>${event.start_date}</td>
                        <td>${event.game}</td>
                    </tr>
                `;
                tableBody.append(row);
            });
        }
    }

    function generatePDF(title, events) {
        if (events.length === 0) {
            alert("No events available for PDF generation.");
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(16);
        doc.text(title, 20, 10);
        doc.setFontSize(12);

        let yPos = 20;
        events.forEach((event, index) => {
            if (yPos > 270) { 
                doc.addPage();
                yPos = 20; 
            }

            doc.text(`Game: ${event.game}`, 20, yPos);
            doc.text(`Event: ${event.event_name}`, 20, yPos + 7);
            doc.text(`Gamer ID: ${event.gamer_id ? event.gamer_id : "N/A"}`, 20, yPos + 14);
            doc.text(`Buyer: ${event.name}`, 20, yPos + 21);
            doc.text(`Phone: ${event.phone}`, 20, yPos + 28);
            doc.text(`Start Date: ${event.start_date}`, 20, yPos + 35);
            doc.line(20, yPos + 40, 190, yPos + 40); 

            yPos += 45;
        });

        doc.save(`${title.replace(/\s+/g, "_")}.pdf`);
    }
function searchByGamerId() {
        let gamerId = $("#searchGamerId").val().trim();
        if (gamerId === "") {
            fetchSoldEvent();
            return;
        }

        $.ajax({
            url: `https://grandroombd.com/api/search_by_gamer_id.php?gamer_id=${gamerId}`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                console.log("Search Response:", response);

                if (response.status === "success" && response.data) {
                    let user = response.data;
                    displaySearchedUser(user);
                } else {
                    $("#eventTableBody").html('<tr><td colspan="6" class="text-danger">No data found for this Gamer ID.</td></tr>');
                }
            },
            error: function (xhr, status, error) {
                console.error("Search Error:", xhr.status, error);
                $("#eventTableBody").html('<tr><td colspan="6" class="text-danger">Error fetching user data.</td></tr>');
            }
        });
    }

    function displaySearchedUser(user) {
        let tableBody = $("#eventTableBody");
        tableBody.empty();

        let row = `
            <tr>
                <td>${user.event_name}</td>
                <td>${user.gamer_id}</td>
                <td>${user.name}</td>
                <td>${user.phone}</td>
                <td>${user.start_date}</td>
                <td>${user.game}</td>
            </tr>
        `;
        tableBody.append(row);
    }


    </script>
</body>

</html>
