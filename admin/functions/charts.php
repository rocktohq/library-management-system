<?php
function studentsStat() {
    include '../../includes/connect.php';

    $query = "SELECT
                department as department,
                COUNT(id) as total
            FROM `students`
            GROUP BY department";
    $result = $connect->query($query);
    if($result->num_rows > 0) {
        foreach($result as $data) {
            $department[] = $data['department'];
            $total[] = $data['total'];
        }
    }
            
    ?>
    
    
    <script>
    const labels = <?php echo json_encode($department); ?>;

    const data = {
        labels: labels,
        datasets: [{
        label: 'Students',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: <?php echo json_encode($total); ?>,
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('studentChart'),
        config
    );
    </script>
<?php } 