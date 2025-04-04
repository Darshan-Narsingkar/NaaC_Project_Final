<?php
session_start();
include('db_connect.php');

// Fetch data from the database
$query = "SELECT department, status, COUNT(*) as count 
          FROM MoUs_data 
          WHERE department = 'extc' 
          GROUP BY department, status";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $department = $row['department'];
    $data[$department]['labels'][] = $row['status'];
    $data[$department]['counts'][] = (int) $row['count'];  // Ensure integer values
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoUs Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .chart-container {
            width: 25%; /* Increased size for better visibility */
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
    <h2>MoUs Analysis - EXTC Department</h2>

    <?php foreach ($data as $department => $chartData) { 
        $chartId = preg_replace('/\s+/', '_', $department); 
    ?>
        <div class="chart-container">
            <h3><?php echo $department; ?> - Bar Chart</h3>
            <canvas id="bar_chart_<?php echo $chartId; ?>"></canvas>
        </div>
        <div class="chart-container">
            <h3><?php echo $department; ?> - Pie Chart</h3>
            <canvas id="pie_chart_<?php echo $chartId; ?>"></canvas>
        </div>
        <p><a href="EXTChod.php">Back to Home</a></p>

    <?php } ?>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD', '#2ECC71', '#FF9F40', '#9966FF'];

        <?php foreach ($data as $department => $chartData) { 
            $chartId = preg_replace('/\s+/', '_', $department);
        ?>
            var labels = <?php echo json_encode($chartData['labels']); ?>;
            var counts = <?php echo json_encode(array_map('intval', $chartData['counts'])); ?>;
            
            var barColors = labels.map((_, index) => colors[index % colors.length]);
            var pieColors = labels.map((_, index) => colors[index % colors.length]);

            // Bar Chart
            var ctxBar = document.getElementById('bar_chart_<?php echo $chartId; ?>').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '<?php echo $department; ?> MoUs Count',
                        data: counts,
                        backgroundColor: barColors,
                        borderColor: '#333',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } },
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    }
                }
            });

            // Pie Chart
            var ctxPie = document.getElementById('pie_chart_<?php echo $chartId; ?>').getContext('2d');
            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '<?php echo $department; ?> MoUs Distribution',
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
