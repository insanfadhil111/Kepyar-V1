<style>
    .cid-u4ayil8qZ2 {
        z-index: 0;
        width: 100%;
        position: relative;
    }
    
    .custom-footer {
        position: relative;
        bottom: 50px; /* Adjust this value to move the footer higher */
        margin-bottom: 0; /* Ensure there's no additional margin below the footer */
    }

    #container-pju {
        padding-top: 120px;
        margin-top: 20px;
    }

    .navbar {
        opacity: 0.75;
    }

    .card {
        margin: 5px;
        opacity: 0.75; 
        background-color: rgba(255, 255, 255, 0.75); /* add a semi-transparent background */
    }
    
    .card-text {
        color: rgba(0, 0, 0, 1); /* change the color to black with 100% opacity */
    }

    .card-body {
        padding: 20px;
    }

    .card-text {
        font-size: 18px;
    }

    .card-group {
        flex-wrap: nowrap;
    }

    .card-group .card {
        flex: 1;
        margin: 10px;
        width: calc(50% - 20px); /* adjust the width to fit two cards in a row */
    }

    .card-group .card:first-child {
        margin-left: 0;
    }

    .card-group .card:last-child {
        margin-right: 0;
    }

    #dayaHarianChart {
        width: 600px;
        height: 600px;
    }

    .map iframe {
        width: 300px;
        height: 400px;
    }

    .row {
        margin-bottom: 20px; /* Add some margin between rows */
    }
    
    #body{
        min-height: 100vh; /* add this line */
        background-image: url("storage/assets/images/kacang (3).JPG");
        background-size: cover;
        overflow:hidden;
        display:flex;
    }
    
    .container-body {
        /* display:flex; */
        justify-content: center;
        padding: 30px;
        margin: 20px auto; /* changed to make it centered */
        /* height: 80%; */
        width: 100%;
    }

    .dropdown-item.active {
        background-color: yellow;
        color: black; /* Optional: adjust text color if needed */
    }

    @media (min-width: 600px) { /* adjust the breakpoint as needed */
    .card-group {
        display:flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .card-group .card {
        width: calc(33.33% - 20px); /* adjust the width to fit 3 cards in a row */
        margin: 10px;
    }
    }
</style>

@extends('landingpage.layouts.main')

@section('content')
<div id="body">
<div id="container-pju" class="container-body">
    <div class="d-flex flex-column align-items-center justify-content-center h-70">
        <!-- Filter PJU -->
        <div class="filter-pju d-flex justify-content-center mb-3 bg-white rounded">
            <a class="dropdown-item mr-2 {{ request()->is('pju1') ? 'active' : '' }}" href="{{ route('pju1') }}">PJU 1</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju2') ? 'active' : '' }}" href="{{ route('pju2') }}">PJU 2</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju3') ? 'active' : '' }}" href="{{ route('pju3') }}">PJU 3</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju4') ? 'active' : '' }}" href="{{ route('pju4') }}">PJU 4</a>
            <a class="dropdown-item mr-2 {{ request()->is('pju5') ? 'active' : '' }}" href="{{ route('pju5') }}">PJU 5</a>
            <a class="dropdown-item {{ request()->is('pju') ? 'active' : '' }}" href="{{ route('pju') }}">PJU All</a>
        </div>
    <!-- Card Group 1: Power and Profit Stats -->
            <div class="col-12">
                <div class="card-group">
                    <!-- Daya Card -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Total Daya Saat Ini</h5>
                            <i class="bi bi-battery-full" style="font-size: 24px;"></i>
                            <h2 id="daya-now" class="card-text">{{ $pjuData->first()->daya ?? 0 }} W</h2>
                        </div>
                    </div>
                    <!-- Daya Hari Ini Card -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Total Energi Hari Ini</h5>
                            <i class="bi bi-calendar-day" style="font-size: 24px;"></i>
                            <h2 id="daya-harian" class="card-text">{{ $pjuData->first()->daya_harian ?? 0 }} Wh</h2>
                        </div>
                    </div>
                    <!-- Profit Hari Ini Card -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Total Profit Hari Ini</h5>
                            <i class="bi bi-cash" style="font-size: 24px;"></i>
                            <h2 id="profit-harian" class="card-text">0.00 IDR</h2>
                            <!-- {{-- {{ $pjuData->first()->profit_harian}} --}} -->
                        </div>
                    </div>
                    <!-- Total Daya Card -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Total Energi Keseluruhan</h5>
                            <i class="bi bi-battery-charging" style="font-size: 24px;"></i>
                            <h2 id="daya-total" class="card-text">0 Wh</h2>
                            <!-- {{-- {{ $pjuData->first()->daya_total}} --}} -->
                        </div>
                    </div>
                    <!-- Total Profit Card -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Total Profit Keseluruhan</h5>
                            <i class="bi bi-piggy-bank" style="font-size: 24px;"></i>
                            <h2 id="profit-total" class="card-text">0.00 IDR</h2>
                            <!-- {{-- {{ $pjuData->first()->profit_total}} --}} -->
                        </div>
                    </div>
                    <!-- Bebas Emisi -->
                    <div class="card shadow-sm p-4 bg-white rounded">
                        <div class="card-body text-center">
                            <h5 style="font-size: 18px;" class="card-title">Emisi yang dihemat</h5>
                            <i class="bi bi-piggy-bank" style="font-size: 24px;"></i>
                            <h2 id="bebas_emisi" class="card-text">0.00 kg</h2>
                            <!-- {{-- {{ $pjuData->first()->bebas_emisi}} --}} -->
                        </div>
                    </div>
                </div>
            </div>
        <!-- Card Group 2: Detailed Information and Chart -->
        <div class="col-12">
            <div class="card-group">
                <div class="card bg-white rounded">
                    <div class="card-body">
                        <i class="bi bi-bar-chart" style="font-size: 24px;">
                            <span> Grafik daya</span>
                        </i>
                        <canvas id="dayaHarianChart"></canvas>
                    </div>
                </div>
                <div class="card bg-white rounded">
                    <div class="card-body">
                        <i class="fa-solid fa-map"></i>
                        <h5 class="card-title">Maps</h5>
                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15810.201793821934!2d111.2784545700888!3d-7.837309547668721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799cac4028fa21%3A0x5027a76e356a1e0!2sKepyar%2C%20Kec.%20Purwantoro%2C%20Kabupaten%20Wonogiri%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1708344616754!5m2!1sid!2sid"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Load Chart.js and the Moment.js adapter library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('dayaHarianChart').getContext('2d');

        fetch('{{ route('pju.getDayaHarianWeeklyData2') }}')
        .then(response => response.json())
        .then(data => {
            console.log('Data fetched from server:', data);

            var labels = [];
            var dayaHarian = [];

            // Memproses data
            data.forEach(item => {
                // Parse the date string using moment.js
                var date = moment(item.date);
                labels.push(date.format('YYYY-MM-DD')); // Format the date for the chart
                dayaHarian.push(item.total_daya_harian);
            });

            // Membuat grafik dengan Chart.js
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Daya Harian (watt)',
                        data: dayaHarian,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time', // Menggunakan skala waktu untuk label tanggal
                            time: {
                                unit: 'day', // Unit waktu yang ditampilkan adalah per hari
                                tooltipFormat: 'YYYY-MM-DD', // Format tanggal yang ditampilkan di tooltip
                                displayFormats: {
                                    day: 'YYYY-MM-DD' // Format tanggal yang ditampilkan
                                }
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });

        function updateData() {
            $.ajax({
                type: 'GET',
                url: '{{ route('pju.getdata2') }}',
                dataType: 'json',
                success: function(data) {
                    $('#daya-now').text(data.daya + ' W');
                    $('#daya-harian').text(data.daya_harian/1000 + ' kWh');
                    $('#profit-harian').text(data.profit_harian + ' IDR');
                    $('#daya-total').text(data.daya_total/1000 + ' kWh');
                    $('#profit-total').text(data.profit_total + ' IDR');
                    $('#bebas_emisi').text(data.bebas_emisi + ' Kg');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Failed to fetch data: " + textStatus, errorThrown);
                }
            });
        }
        // Update data setiap 5 detik
        setInterval(updateData, 5000);
        updateData(); // Panggil sekali saat halaman pertama kali dimuat
    });
</script>

@endsection

@section('footer')
<footer class="text-center py-3 bg-dark text-white custom-footer">
    Group Riset Teknologi Kendaraan Listrik dan Sistem Energi Berkelanjutan Teknik Elektro Fakultas Teknik Universitas Sebelas Maret
</footer>
@endsection