Pie Chart
<?php
include("../Assets/Connection/Connection.php");
ob_start();
include("Head.php");

$xValues = [];
$yValues = [];

// Fetch category names
$selX = "SELECT * FROM tbl_maincategory";
$resX = $con->query($selX);
while ($dataX = $resX->fetch_assoc()) {
    $xValues[] = $dataX['mcategory_name'];

    // Fetch count of items in cart per category
    $selY = "SELECT COUNT(*) as count 
             FROM tbl_cart c 
             INNER JOIN tbl_product p ON p.product_id = c.product_id 
             INNER JOIN tbl_subcategory s ON s.subcategory_id = p.subcategory_id 
             INNER JOIN tbl_category ct ON ct.category_id = s.category_id
             INNER JOIN tbl_maincategory m ON m.mcategory_id = ct.mcategory_id
             WHERE m.mcategory_id = " . $dataX['mcategory_id'] . " 
             AND cart_status=6";
    $resY = $con->query($selY);
    $dataY = $resY->fetch_assoc();
    $yValues[] = $dataY['count'];
}

// Encode PHP arrays to JSON for use in JavaScript
$xValuesJson = json_encode($xValues);
$yValuesJson = json_encode($yValues);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Assets/JQ/jQuery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container my-5">
        <h2 class="text-center">Items in Cart per Category</h2>
        <div class="chart_area" style="display:flex;justify-content: center;">
            <div class="chart_box" style="height:450px;width:450px;">
        <canvas id="pieChart"></canvas>
        </div>
        </div>
    </div>

    <script>
        // Fetch PHP arrays as JavaScript variables
        const xValues = <?php echo $xValuesJson; ?>;
        const yValues = <?php echo $yValuesJson; ?>;

        // Function to generate pastel bright colors
        function generatePastelBrightColorPalettes(numColors) {
    const fillColors = [];
    const borderColors = [];
    const colorStep = 360 / numColors;

    for (let i = 0; i < numColors; i++) {
        const hue = Math.round(i * colorStep);

        // Generate pastel RGB values for bright colors
        const saturation = 50 + Math.random() * 30; // Adjust the saturation range
        const lightness = 65 + Math.random() * 30;  // Adjust the lightness for pastel effect

        const fillColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 0.65)`; // 0.65 alpha for fill
        const borderColor = `hsla(${hue}, ${saturation}%, ${lightness}%, 1)`;  // 1 alpha for border

        fillColors.push(fillColor);
        borderColors.push(borderColor);
    }
    return { fillColors, borderColors };
}


        // Generate colors based on the number of categories
        const colorPalettes = generatePastelBrightColorPalettes(xValues.length);

        // Create Pie Chart using Chart.js
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: xValues,
                datasets: [{
                    data: yValues,
                    backgroundColor: colorPalettes.fillColors,
                    borderColor: colorPalettes.borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return xValues[tooltipItem.dataIndex] + ': ' + yValues[tooltipItem.dataIndex];
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>