@extends('Master.Layouts.app', ['title' => $title])

@section('content')
<style>
    .modern-dashboard {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .modern-page-header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .modern-page-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }
    
    .modern-breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }
    
    .modern-breadcrumb .breadcrumb-item {
        color: #6c757d;
        font-weight: 500;
    }
    
    .modern-breadcrumb .breadcrumb-item.active {
        color: #495057;
        font-weight: 600;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .modern-stat-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .modern-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-gradient);
        border-radius: 20px 20px 0 0;
    }
    
    .modern-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .modern-stat-card.primary {
        --card-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .modern-stat-card.secondary {
        --card-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .modern-stat-card.success {
        --card-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .modern-stat-card.info {
        --card-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    
    .modern-stat-card.danger {
        --card-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    
    .modern-stat-card.warning {
        --card-gradient: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
    }
    
    .modern-stat-card.purple {
        --card-gradient: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    }
    
    .stat-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .stat-info h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
        line-height: 1;
    }
    
    .stat-info p {
        font-size: 1rem;
        font-weight: 600;
        color: #718096;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--card-gradient);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon i {
        font-size: 2rem;
        color: white;
    }
    
    /* Welcome Section Styles */
    .welcome-section {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px 15px 0 0;
    }
    
    .welcome-greeting {
        font-size: 1.4rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        animation: fadeInUp 0.8s ease-out;
    }
    
    .welcome-subtitle {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 1rem;
        font-weight: 500;
        animation: fadeInUp 0.8s ease-out 0.1s both;
    }
    
    .datetime-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    
    .date-display, .time-display {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 0.8rem 1.2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        animation: fadeInUp 0.8s ease-out 0.2s both;
        min-width: 120px;
    }
    
    .date-display:hover, .time-display:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    }
    
    .date-label, .time-label {
        font-size: 0.7rem;
        color: #a0aec0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }
    
    .date-value {
        font-size: 1rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        line-height: 1.2;
    }
    
    .time-value {
        font-size: 1.4rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
        font-family: 'Courier New', monospace;
        letter-spacing: 1px;
    }
    
    .time-seconds {
        font-size: 1rem;
        color: #667eea;
        animation: pulse 1s infinite;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    .weather-icon {
        font-size: 2rem;
        color: #ffd700;
        margin-bottom: 0.5rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-5px);
        }
        60% {
            transform: translateY(-2px);
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .modern-page-header {
            padding: 1.5rem;
        }
        
        .modern-page-title {
            font-size: 2rem;
        }
        
        .modern-stat-card {
            padding: 1.5rem;
        }
        
        .stat-info h2 {
            font-size: 2rem;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
        }
        
        .stat-icon i {
            font-size: 1.5rem;
        }
        
        .welcome-section {
             padding: 1rem;
         }
         
         .welcome-greeting {
             font-size: 1.2rem;
         }
         
         .datetime-container {
             gap: 1rem;
             flex-direction: column;
         }
         
         .date-display, .time-display {
             padding: 0.6rem 1rem;
             min-width: 100px;
         }
         
         .time-value {
             font-size: 1.2rem;
         }
         
         .date-value {
             font-size: 0.9rem;
         }
    }
    
    /* Charts Section Styles */
    .charts-section {
        margin-top: 3rem;
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
    }
    
    .section-subtitle {
        font-size: 1.1rem;
        color: #718096;
        font-weight: 500;
    }
    
    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }
    
    .chart-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .chart-card.full-width {
        grid-column: 1 / -1;
    }
    
    .chart-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px 20px 0 0;
    }
    
    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    
    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .chart-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }
    
    .chart-controls {
        display: flex;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 0.3rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .chart-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        background: transparent;
        color: #718096;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .chart-btn:hover {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }
    
    .chart-btn.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }
    
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    .chart-card.full-width .chart-container {
        height: 400px;
    }
    
    @media (max-width: 768px) {
        .charts-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .chart-card {
            padding: 1.5rem;
        }
        
        .chart-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .chart-card.full-width .chart-container {
            height: 300px;
        }
    }
</style>

<div class="modern-dashboard">
    <!-- WELCOME SECTION -->
    <div class="welcome-section">
        <div class="weather-icon">
            <i class="fe fe-sun"></i>
        </div>
        <h1 class="welcome-greeting" id="greeting">Selamat Datang!</h1>
        <p class="welcome-subtitle">Semoga hari Anda menyenangkan dan produktif</p>
        
        <div class="datetime-container">
            <div class="date-display">
                <div class="date-label">Tanggal Hari Ini</div>
                <div class="date-value" id="currentDate">Loading...</div>
            </div>
            <div class="time-display">
                <div class="time-label">Waktu Sekarang</div>
                <div class="time-value" id="currentTime">Loading...</div>
            </div>
        </div>
    </div>
    <!-- WELCOME SECTION END -->
    
    <!-- PAGE-HEADER -->
    <div class="modern-page-header">
        <h1 class="modern-page-title">Dashboard</h1>
        <div>
            <ol class="breadcrumb modern-breadcrumb">
                <li class="breadcrumb-item text-gray">Admin</li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- STATS GRID -->
    <div class="stats-grid">
        <!-- Jenis Barang -->
        <div class="modern-stat-card primary">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$jenis}}</h2>
                    <p>Jenis Barang</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-package"></i>
                </div>
            </div>
        </div>
        
        <!-- Satuan Barang -->
        <div class="modern-stat-card secondary">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$satuan}}</h2>
                    <p>Satuan Barang</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-package"></i>
                </div>
            </div>
        </div>
        
        <!-- Merk Barang -->
        <div class="modern-stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$merk}}</h2>
                    <p>Merk Barang</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-package"></i>
                </div>
            </div>
        </div>
        
        <!-- Barang -->
        <div class="modern-stat-card info">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$barang}}</h2>
                    <p>Barang</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-package"></i>
                </div>
            </div>
        </div>
        
        <!-- Barang Masuk -->
        <div class="modern-stat-card success">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$bm}}</h2>
                    <p>Barang Masuk</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-trending-up"></i>
                </div>
            </div>
        </div>
        
        <!-- Barang Keluar -->
        <div class="modern-stat-card danger">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$bk}}</h2>
                    <p>Barang Keluar</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-trending-down"></i>
                </div>
            </div>
        </div>
        
        <!-- Customer -->
        <div class="modern-stat-card purple">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$customer}}</h2>
                    <p>Customer</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-users"></i>
                </div>
            </div>
        </div>
        
        <!-- User -->
        <div class="modern-stat-card warning">
            <div class="stat-content">
                <div class="stat-info">
                    <h2>{{$user}}</h2>
                    <p>User</p>
                </div>
                <div class="stat-icon">
                    <i class="fe fe-user"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- STATS GRID END -->
    
    <!-- CHARTS SECTION -->
    <div class="charts-section">
        <div class="section-header">
            <h2 class="section-title">Analisis Data</h2>
            <p class="section-subtitle">Visualisasi data inventory dalam bentuk grafik interaktif</p>
        </div>
        
        <div class="charts-grid">
            <!-- Inventory Overview Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Overview Inventory</h3>
                    <div class="chart-controls">
                        <button class="chart-btn active" data-chart="pie">Pie</button>
                        <button class="chart-btn" data-chart="doughnut">Doughnut</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="inventoryChart"></canvas>
                </div>
            </div>
            
            <!-- Flow Analysis Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Alur Barang</h3>
                    <div class="chart-controls">
                        <button class="chart-btn active" data-chart="bar">Bar</button>
                        <button class="chart-btn" data-chart="line">Line</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="flowChart"></canvas>
                </div>
            </div>
            
            <!-- Users Statistics Chart -->
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Statistik Pengguna</h3>
                    <div class="chart-controls">
                        <button class="chart-btn active" data-chart="radar">Radar</button>
                        <button class="chart-btn" data-chart="polarArea">Polar</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="usersChart"></canvas>
                </div>
            </div>
            
            <!-- Trend Analysis Chart -->
            <div class="chart-card full-width">
                <div class="chart-header">
                    <h3 class="chart-title">Trend Analysis</h3>
                    <div class="chart-controls">
                        <button class="chart-btn active" data-period="week">Minggu</button>
                        <button class="chart-btn" data-period="month">Bulan</button>
                        <button class="chart-btn" data-period="year">Tahun</button>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="trendChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- CHARTS SECTION END -->
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Function to update time and date
    function updateDateTime() {
        const now = new Date();
        
        // Update time
        const timeOptions = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };
        const timeString = now.toLocaleTimeString('id-ID', timeOptions);
        document.getElementById('currentTime').innerHTML = timeString.replace(/:/g, '<span class="time-seconds">:</span>');
        
        // Update date
        const dateOptions = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const dateString = now.toLocaleDateString('id-ID', dateOptions);
        document.getElementById('currentDate').textContent = dateString;
        
        // Update greeting based on time
        const hour = now.getHours();
        let greeting = '';
        let icon = 'fe-sun';
        
        if (hour >= 5 && hour < 12) {
            greeting = 'Selamat Pagi!';
            icon = 'fe-sunrise';
        } else if (hour >= 12 && hour < 15) {
            greeting = 'Selamat Siang!';
            icon = 'fe-sun';
        } else if (hour >= 15 && hour < 18) {
            greeting = 'Selamat Sore!';
            icon = 'fe-sunset';
        } else {
            greeting = 'Selamat Malam!';
            icon = 'fe-moon';
        }
        
        document.getElementById('greeting').textContent = greeting;
        document.querySelector('.weather-icon i').className = 'fe ' + icon;
    }
    
    // Update immediately and then every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
    
    // Chart.js Configuration and Data
    const chartColors = {
        primary: ['#667eea', '#764ba2', '#f093fb', '#f5576c', '#4facfe', '#00f2fe', '#43e97b', '#38f9d7'],
        gradient: {
            blue: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            pink: 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
            cyan: 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
            green: 'linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)'
        }
    };
    
    // Sample data - replace with actual data from your backend
    const inventoryData = {
        jenisBarang: {{$jenis ?? 25}},
        satuan: {{$satuan ?? 15}},
        merk: {{$merk ?? 30}},
        barang: {{$barang ?? 120}},
        barangMasuk: {{$bm ?? 85}},
        barangKeluar: {{$bk ?? 65}},
        customer: {{$customer ?? 45}},
        user: {{$user ?? 12}}
    };
    
    // Define dashData10 to prevent errors from existing scripts
    window.dashData10 = {
        series: [inventoryData.barangMasuk, inventoryData.barangKeluar],
        labels: ['Barang Masuk', 'Barang Keluar']
    };
    
    // Initialize Charts
    let inventoryChart, flowChart, usersChart, trendChart;
    
    // Inventory Overview Chart (Pie/Doughnut)
    function initInventoryChart(type = 'pie') {
        const ctx = document.getElementById('inventoryChart').getContext('2d');
        
        if (inventoryChart) {
            inventoryChart.destroy();
        }
        
        inventoryChart = new Chart(ctx, {
            type: type,
            data: {
                labels: ['Jenis Barang', 'Satuan', 'Merk', 'Total Barang'],
                datasets: [{
                    data: [inventoryData.jenisBarang, inventoryData.satuan, inventoryData.merk, inventoryData.barang],
                    backgroundColor: chartColors.primary.slice(0, 4),
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverBorderWidth: 5,
                    hoverBorderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 10,
                        displayColors: true
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true,
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
    
    // Flow Analysis Chart (Bar/Line)
    function initFlowChart(type = 'bar') {
        const ctx = document.getElementById('flowChart').getContext('2d');
        
        if (flowChart) {
            flowChart.destroy();
        }
        
        flowChart = new Chart(ctx, {
            type: type,
            data: {
                labels: ['Barang Masuk', 'Barang Keluar'],
                datasets: [{
                    label: 'Jumlah',
                    data: [inventoryData.barangMasuk, inventoryData.barangKeluar],
                    backgroundColor: type === 'bar' ? 
                        ['rgba(102, 126, 234, 0.8)', 'rgba(245, 87, 108, 0.8)'] : 
                        'rgba(102, 126, 234, 0.2)',
                    borderColor: ['#667eea', '#f5576c'],
                    borderWidth: 3,
                    tension: 0.4,
                    fill: type === 'line'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: type === 'line',
                        position: 'top'
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 10
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            font: {
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: '600'
                            }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
    
    // Users Statistics Chart (Radar/Polar Area)
    function initUsersChart(type = 'radar') {
        const ctx = document.getElementById('usersChart').getContext('2d');
        
        if (usersChart) {
            usersChart.destroy();
        }
        
        const data = type === 'radar' ? {
            labels: ['Admin', 'Manager', 'Staff', 'Customer'],
            datasets: [{
                label: 'Aktivitas',
                data: [inventoryData.user, inventoryData.user * 0.8, inventoryData.user * 1.2, inventoryData.customer],
                backgroundColor: 'rgba(102, 126, 234, 0.2)',
                borderColor: '#667eea',
                borderWidth: 3,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        } : {
            labels: ['Users', 'Customers'],
            datasets: [{
                data: [inventoryData.user, inventoryData.customer],
                backgroundColor: ['rgba(102, 126, 234, 0.8)', 'rgba(245, 87, 108, 0.8)'],
                borderColor: ['#667eea', '#f5576c'],
                borderWidth: 3
            }]
        };
        
        usersChart = new Chart(ctx, {
            type: type,
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 10
                    }
                },
                scales: type === 'radar' ? {
                    r: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(102, 126, 234, 0.2)'
                        },
                        pointLabels: {
                            font: {
                                weight: '600'
                            }
                        }
                    }
                } : {},
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
    
    // Trend Analysis Chart
    function initTrendChart(period = 'week') {
        const ctx = document.getElementById('trendChart').getContext('2d');
        
        if (trendChart) {
            trendChart.destroy();
        }
        
        let labels, data1, data2;
        
        switch(period) {
            case 'week':
                labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                data1 = [12, 19, 15, 25, 22, 18, 20];
                data2 = [8, 15, 12, 18, 16, 14, 16];
                break;
            case 'month':
                labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
                data1 = [65, 78, 85, 92, 88, 95];
                data2 = [45, 58, 65, 72, 68, 75];
                break;
            case 'year':
                labels = ['2020', '2021', '2022', '2023', '2024'];
                data1 = [450, 520, 580, 650, 720];
                data2 = [320, 380, 420, 480, 540];
                break;
        }
        
        trendChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Barang Masuk',
                    data: data1,
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    borderColor: '#667eea',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }, {
                    label: 'Barang Keluar',
                    data: data2,
                    backgroundColor: 'rgba(245, 87, 108, 0.1)',
                    borderColor: '#f5576c',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#f5576c',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: '#ffffff',
                        bodyColor: '#ffffff',
                        borderColor: '#667eea',
                        borderWidth: 1,
                        cornerRadius: 10,
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            font: {
                                weight: '600'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                weight: '600'
                            }
                        }
                    }
                },
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }
    
    // Add some interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize all charts
        initInventoryChart();
        initFlowChart();
        initUsersChart();
        initTrendChart();
        
        // Chart control buttons
        document.querySelectorAll('.chart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const chartType = this.dataset.chart;
                const period = this.dataset.period;
                const parent = this.closest('.chart-card');
                
                // Update active state
                parent.querySelectorAll('.chart-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                // Update charts based on button clicked
                if (chartType && parent.querySelector('#inventoryChart')) {
                    initInventoryChart(chartType);
                } else if (chartType && parent.querySelector('#flowChart')) {
                    initFlowChart(chartType);
                } else if (chartType && parent.querySelector('#usersChart')) {
                    initUsersChart(chartType);
                } else if (period && parent.querySelector('#trendChart')) {
                    initTrendChart(period);
                }
            });
        });
        
        // Add click effect to time display
        document.querySelector('.time-display').addEventListener('click', function() {
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
        
        // Add click effect to date display
        document.querySelector('.date-display').addEventListener('click', function() {
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
        
        // Add chart card animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.chart-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(card);
        });
    });
</script>

@endsection