<?php
session_start();
include('db_connect.php');

// Fetch ONLY IT department data
$query = "SELECT status, COUNT(*) as count FROM research_papers WHERE department = 'IT' GROUP BY status";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$data = ['labels' => [], 'counts' => []];
while ($row = mysqli_fetch_assoc($result)) {
    $data['labels'][] = $row['status'];
    $data['counts'][] = $row['count'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Department - Research Papers Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .chart-container {
            width: 25%;
            display: inline-block;
            margin: 20px;
        }
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h2>IT Department - Research Papers Analysis</h2>

    <div class="chart-container">
        <h3>IT Department - Bar Chart</h3>
        <canvas id="bar_chart_IT"></canvas>
    </div>

    <div class="chart-container">
        <h3>IT Department - Pie Chart</h3>
        <canvas id="pie_chart_IT"></canvas>
    </div>

    <p><a href="hod.php">Back to Home</a></p>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var labels = <?php echo json_encode($data['labels']); ?>;
        var counts = <?php echo json_encode($data['counts']); ?>;

        console.log("Labels: ", labels);
        console.log("Counts: ", counts);

        if (labels.length === 0 || counts.length === 0) {
            console.warn("No data available for IT department.");
            return;
        }

        var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD', '#2ECC71', '#FF9F40', '#9966FF'];

        var barColors = labels.map((_, index) => colors[index % colors.length]);
        var pieColors = labels.map((_, index) => colors[index % colors.length]);

        // Bar Chart
        var ctxBar = document.getElementById('bar_chart_IT').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'IT Research Papers Count',
                    data: counts,
                    backgroundColor: barColors,
                    borderColor: '#333',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                }
            }
        });

        // Pie Chart
        var ctxPie = document.getElementById('pie_chart_IT').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'IT Research Papers Distribution',
                    data: counts,
                    backgroundColor: pieColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    tooltip: { enabled: true }
                }
            }
        });

    });
    </script>

</body>
</html>
