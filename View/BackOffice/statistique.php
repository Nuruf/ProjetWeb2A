<?php
require_once 'C:\xampp\htdocs\projet web\controller\reclamationcontroller.php';

// Initialize the controller
$reclamationController = new ReclamationController();

// Get counts of open and closed reclamations
$totalCounts = $reclamationController->getReclamationCountsByStatus();
$totalReclamations = $totalCounts['open'] + $totalCounts['closed'];

// Calculate percentages
$openPercentage = $totalReclamations > 0 ? ($totalCounts['open'] / $totalReclamations) * 100 : 0;
$closedPercentage = $totalReclamations > 0 ? ($totalCounts['closed'] / $totalReclamations) * 100 : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reclamation Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js library -->
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            margin: 0;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        .stat-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
            height: auto;
            margin: 20px auto;
        }

        /* Back Button Styles */
        button {
            padding: 10px 20px;
            background-color: #007acc;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #005f99;
        }
    </style>
</head>
<body>
    <h1>Reclamation Statistics</h1>
    <div class="stat-container">
        <canvas id="reclamationChart"></canvas> <!-- Pie Chart -->
    </div>
    <form action="reclamationlistadmin.php" method="post" style="display:inline;">
        <button type="submit">Back to Reclamation List</button>
    </form>

    <script>
        // Data for the chart
        const data = {
            labels: ['Open Reclamations', 'Closed Reclamations'],
            datasets: [{
                label: 'Reclamations Percentage',
                data: [<?= $openPercentage ?>, <?= $closedPercentage ?>],
                backgroundColor: ['#007acc', '#28a745'], // Colors for the segments
                borderColor: ['#004c80', '#1d6f34'], // Border colors
                borderWidth: 1
            }]
        };

        // Configuration for the pie chart
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let percentage = context.raw.toFixed(2);
                                return `${context.label}: ${percentage}%`;
                            }
                        }
                    }
                }
            }
        };

        // Render the pie chart
        const reclamationChart = new Chart(
            document.getElementById('reclamationChart'),
            config
        );
    </script>
</body>
</html>
