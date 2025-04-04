<?php
session_start();
include('db_connect.php');

// Fetch data from the database
$query = "SELECT department, status, COUNT(*) AS count 
FROM research_awards 
WHERE department = 'cse' 
GROUP BY department, status;
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dept = $row['department'];
    if (!isset($data[$dept])) {
        $data[$dept] = ['labels' => [], 'counts' => []];
    }
    $data[$dept]['labels'][] = $row['status'];
    $data[$dept]['counts'][] = $row['count'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Awards Analysis  CSE </title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        .chart-container {
            width: 25%;
            display: inline-block;
            margin: 20px;
            text-align: center;
        }
        canvas {
            max-width: 100%;
        }
        a {
            display: block;
            margin-top: 20px;
            font-size: 18px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Research Awards Analysis by  CSE Department</h2>

    <?php if (!empty($data)): ?>
        <?php foreach ($data as $department => $chartData): ?>
            <div class="chart-container">
                <h3><?php echo htmlspecialchars($department); ?> Department - Bar Chart</h3>
                <canvas id="bar_chart_<?php echo preg_replace('/\s+/', '_', $department); ?>"></canvas>
            </div>
            <div class="chart-container">
                <h3><?php echo htmlspecialchars($department); ?> Department - Pie Chart</h3>
                <canvas id="pie_chart_<?php echo preg_replace('/\s+/', '_', $department); ?>"></canvas>
            </div>
        <?php endforeach; ?>
        <a href="hod.php">Back to Home</a>
    <?php else: ?>
        <p>No data available for research awards.</p>
        <a href="hod.php">Back to Home</a>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#8E44AD', '#2ECC71', '#FF9F40', '#9966FF'];

            <?php foreach ($data as $department => $chartData): 
                $chartId = preg_replace('/\s+/', '_', $department);
            ?>
                var labels = <?php echo json_encode($chartData['labels']); ?>;
                var counts = <?php echo json_encode($chartData['counts']); ?>;
                
                var dynamicColors = labels.map((_, index) => colors[index % colors.length]);

                // Bar Chart
                var ctxBar = document.getElementById('bar_chart_<?php echo $chartId; ?>').getContext('2d');
                new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '<?php echo htmlspecialchars($department); ?> Research Awards Count',
                            data: counts,
                            backgroundColor: dynamicColors,
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
                var ctxPie = document.getElementById('pie_chart_<?php echo $chartId; ?>').getContext('2d');
                new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '<?php echo htmlspecialchars($department); ?> Research Awards Distribution',
                            data: counts,
                            backgroundColor: dynamicColors,
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

            <?php endforeach; ?>
        });
    </script>
</body>
</html>
