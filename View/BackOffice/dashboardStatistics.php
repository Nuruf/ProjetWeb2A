<?php
include '../../controller/CategoryController.php';

$controller = new categoriesController();
$data = $controller->getCategoryStatistics();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashboard1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Statistics</h1>
    <br>
    <br><hr>
    <a href="javascript:history.back()" >Retour</a>

    <div class="container mt-5">
        <canvas id="categoryChart" width="400" height="200"></canvas>
        <script>
            // PHP to JavaScript: Pass data dynamically
            const data = <?php echo json_encode($data); ?>;

            // Prepare labels and counts
            const labels = data.map(item => item.category);
            const counts = data.map(item => item.count);

            // Render the Chart
            const ctx = document.getElementById('categoryChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Change to 'line' for a curve
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Courses per Category',
                        data: counts,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</body>
</html>
