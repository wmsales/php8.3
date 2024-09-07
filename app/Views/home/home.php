<?php include __DIR__ . '/../layouts/header.php'; ?>

<!-- Integración de Chart.js -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid">
    <!-- Título del Dashboard -->
    <div class="row">
        <div class="col-12 text-center my-4">
            <h1 class="text-dark">Dashboard</h1>
            <p class="text-muted">Bienvenido al sistema ERP FerreToolsApp</p>
        </div>
    </div>
    
    <!-- Sección de tarjetas con gráficos -->
    <div class="row">
        <!-- Tarjeta de Ventas Totales -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ventas Totales</h5>
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pedidos Pendientes -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <canvas id="pedidosPendientesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Clientes Activos -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Clientes Activos</h5>
                    <canvas id="clientesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Pedidos Facturados -->
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Facturados</h5>
                    <canvas id="pedidosFacturadosChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para los gráficos de Chart.js -->
<script>
    const ctxVentas = document.getElementById('ventasChart').getContext('2d');
    const ventasChart = new Chart(ctxVentas, {
        type: 'bar',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Ventas Totales',
                data: [50, 60, 70, 80, 90],
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxClientes = document.getElementById('clientesChart').getContext('2d');
    const clientesChart = new Chart(ctxClientes, {
        type: 'line',
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            datasets: [{
                label: 'Clientes Activos',
                data: [30, 50, 40, 70, 60],
                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxPedidosPendientes = document.getElementById('pedidosPendientesChart').getContext('2d');
    const pedidosPendientesChart = new Chart(ctxPedidosPendientes, {
        type: 'doughnut',
        data: {
            labels: ['Pendientes', 'Completados'],
            datasets: [{
                label: 'Pedidos',
                data: [30, 70],
                backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    const ctxPedidosFacturados = document.getElementById('pedidosFacturadosChart').getContext('2d');
    const pedidosFacturadosChart = new Chart(ctxPedidosFacturados, {
        type: 'pie',
        data: {
            labels: ['Facturados', 'No Facturados'],
            datasets: [{
                label: 'Pedidos Facturados',
                data: [40, 60],
                backgroundColor: ['rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
