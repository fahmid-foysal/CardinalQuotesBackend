<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Banners</title>
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div id="main-wrapper">
        <div class="page-wrapper bg-white">
            <div class="container mt-4">
                <h4 class="text-primary">Available Banners</h4>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <button class="btn btn-success" onclick="showPopup()">Upload Banner</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Banner Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="BannerTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createEventModal" tabindex="-1" aria-labelledby="createEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEventModalLabel">Upload New Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createEventForm">
                        <div class="mb-3 freefire-fields">
                            <label class="form-label">Map Image</label>
                            <input type="file" class="form-control" id="mapImage" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(fetchBanners);

        function fetchBanners() {
            $.ajax({
                url: "https://grandroombd.com/api/get_all_slider.php",
                type: "GET",
                success: function (response) {
                    if (response.status === "success") {
                        let tableBody = $("#BannerTableBody");
                        tableBody.empty();
                        response.data.forEach((banner, index) => {
                            let row = `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td><img src="${banner.image_url}" width="150"></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="deleteBanner(${banner.id})">Delete</button>
                                    </td>
                                </tr>
                            `;
                            tableBody.append(row);
                        });
                    }
                },
                error: function () {
                    console.error("Error fetching banners.");
                }
            });
        }

        function showPopup() {
            $('#createEventModal').modal('show');
        }

        function uploadBanner() {
            let formData = new FormData();
            let fileInput = document.getElementById("mapImage");
            
            if (fileInput.files.length === 0) {
                alert("Please select an image file.");
                return;
            }
            
            formData.append("image_url", fileInput.files[0]);
            
            $.ajax({
                url: "https://grandroombd.com/api/upload_slider.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === "success") {
                        alert("Image uploaded successfully!");
                        $('#createEventModal').modal('hide');
                        fetchBanners();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("Error uploading image.");
                }
            });
        }

        function deleteBanner(sliderId) {
            if (!confirm("Are you sure you want to delete this banner?")) {
                return;
            }
            
            $.ajax({
                url: `https://grandroombd.com/api/delete_slider.php?slider_id=${sliderId}`,
                type: "DELETE",
                success: function(response) {
                    if (response.status === "success") {
                        alert("Slider deleted successfully!");
                        fetchBanners();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("Error deleting slider.");
                }
            });
        }

        $(document).ready(function() {
            $("#createEventForm").submit(function(event) {
                event.preventDefault();
                uploadBanner();
            });
        });
    </script>
</body>
</html>
