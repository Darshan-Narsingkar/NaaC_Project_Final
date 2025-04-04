<?php
session_start();

include('db_connect.php');

// Fetch data only for CSE department
$query = "SELECT department, status, COUNT(*) as count FROM research_papers WHERE department='CSE' GROUP BY department, status";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['department']]['labels'][] = $row['status'];
    $data[$row['department']]['counts'][] = $row['count'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSE Department Research Papers Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .chart-container {
            width: 40%;
            display: inline-block;
            margin: 20px;
            text-align: center;
        }
        canvas {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h2>CSE Department Research Papers Analysis</h2>

    <?php if (!empty($data['CSE'])) { ?>
        <div class="chart-container">
            <h3>CSE Department - Bar Chart</h3>
            <canvas id="bar_chart_CSE"></canvas>
        </div>
        <div class="chart-container">
            <h3>CSE Department - Pie Chart</h3>
            <canvas id="pie_chart_CSE"></canvas>
        </div>
    <?php } else { ?>
        <p>No data found for CSE Department.</p>
    <?php } ?>

    <p><a href="CSEhod.php">Back to Home</a></p>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD', '#2ECC71', '#FF9F40', '#9966FF'];

        <?php if (!empty($data['CSE'])) { ?>
            var labels = <?php echo json_encode($data['CSE']['labels']); ?>;
            var counts = <?php echo json_encode($data['CSE']['counts']); ?>;
            
            // Assign colors dynamically
            var barColors = labels.map((_, index) => colors[index % colors.length]);
            var pieColors = labels.map((_, index) => colors[index % colors.length]);

            // Bar Chart
            var ctxBar = document.getElementById('bar_chart_CSE').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'CSE Research Papers Count',
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
            var ctxPie = document.getElementById('pie_chart_CSE').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'CSE Research Papers Distribution',
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

        <?php } ?>
    });
    </script>
</body>
</html>
