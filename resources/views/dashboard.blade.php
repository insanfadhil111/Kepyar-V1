<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Monitoring PJU') }}
            </h2>
            <button id="export-btn" class="bg-blue-500 text-white px-4 py-2 rounded">Export CSV</button>
        </div>
    </x-slot>
    
    <style>
        .battery-icon {
    width: 60px; /* Reduced width for a more compact battery icon */
    height: 30px; /* Adjusted height */
    border: 2px solid #000;
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.battery-icon::before {
    content: '';
    width: 5px;
    height: 10px; /* Adjusted height for the battery terminal */
    background: #000;
    position: absolute;
    top: calc(50% - 5px);
    right: -7px;
}

.bar {
    width: 20%; /* Adjusted width for more compact bars */
    height: 100%;
    background: #FFB74D; /* Orange pastel */
    margin-right: 2px;
    display: none; /* Initially hide all bars */
}

.
.bar1 { display: block; } /* Ensure at least one bar is always displayed */

    </style>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center">
                        <h2>Monitoring PJU</h2>
                        <div class="flex space-x-4">
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="all">All PJU</button>
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="pju1">PJU1</button>
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="pju2">PJU2</button>
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="pju3">PJU3</button>
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="pju4">PJU4</button>
                            <button class="pju-filter-btn bg-gray-200 text-gray-800 px-4 py-2 rounded" data-pju="pju5">PJU5</button>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Daya Saat Ini</h5>
                                <i class="fas fa-bolt fa-2x text-orange-500"></i>
                                <p class="text-3xl" id="daya">0 kW</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Energi Hari Ini</h5>
                                <i class="fas fa-sun fa-2x text-orange-500"></i>
                                <p class="text-3xl" id="daya_harian">0 kWh</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Energi Keseluruhan</h5>
                                <i class="fas fa-lightbulb fa-2x text-orange-500"></i>
                                <p class="text-3xl" id="daya_total">0 kWh</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Profit Hari Ini</h5>
                                <i class="fas fa-chart-line fa-2x text-orange-500"></i>
                                <p class="text-3xl" id="profit_harian">0 IDR</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Profit</h5>
                                <i class="fas fa-money-bill-alt fa-2x text-orange-500"></i>
                                <p class="text-3xl" id="profit_total">0 IDR</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">Total Emisi</h5>
                                <i class="fas fa-industry fa-2x text-orange-500"></i>
                                <i class="bi bi-cloud-fog2-fill text-orange-500"></i>
                                <p class="text-3xl" id="emisi">0 IDR</p>
                            </div>
                        </div>
                    </div>


                    <h2 class="mt-4">Monitoring Tegangan Baterai</h2>
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4" id="pju1">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">PJU1 - Tegangan Baterai</h5>
                                <div class="battery-icon">
                                    <div class="bar bar1"></div>
                                    <div class="bar bar2"></div>
                                    <div class="bar bar3"></div>
                                    <div class="bar bar4"></div>
                                </div>
                                <p class="text-3xl" id="pju1-voltage">0 V</p>
                                <p class="text-3xl" id="pju1-percentage">0%</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4" id="pju2">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">PJU2 - Tegangan Baterai</h5>
                                <div class="battery-icon">
                                    <div class="bar bar1"></div>
                                    <div class="bar bar2"></div>
                                    <div class="bar bar3"></div>
                                    <div class="bar bar4"></div>
                                </div>
                                <p class="text-3xl" id="pju2-voltage">0 V</p>
                                <p class="text-3xl" id="pju2-percentage">0%</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4" id="pju3">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">PJU3 - Tegangan Baterai</h5>
                                <div class="battery-icon">
                                    <div class="bar bar1"></div>
                                    <div class="bar bar2"></div>
                                    <div class="bar bar3"></div>
                                    <div class="bar bar4"></div>
                                </div>
                                <p class="text-3xl" id="pju3-voltage">0 V</p>
                                <p class="text-3xl" id="pju3-percentage">0%</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4" id="pju4">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">PJU4 - Tegangan Baterai</h5>
                                <div class="battery-icon">
                                    <div class="bar bar1"></div>
                                    <div class="bar bar2"></div>
                                    <div class="bar bar3"></div>
                                    <div class="bar bar4"></div>
                                </div>
                                <p class="text-3xl" id="pju4-voltage">0 V</p>
                                <p class="text-3xl" id="pju4-percentage">0%</p>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 xl:w-1/3 p-4" id="pju5">
                            <div class="bg-orange-100 p-4 rounded">
                                <h5 class="text-lg">PJU5 - Tegangan Baterai</h5>
                                <div class="battery-icon">
                                    <div class="bar bar1"></div>
                                    <div class="bar bar2"></div>
                                    <div class="bar bar3"></div>
                                    <div class="bar bar4"></div>
                                </div>
                                <p class="text-3xl" id="pju5-voltage">0 V</p>
                                <p class="text-3xl" id="pju5-percentage">0%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // function calculatePercentage(voltage) {
            //     const minVoltage = 2.6;
            //     const maxVoltage = 3.5;
            //     let percentage = ((voltage - minVoltage) / (maxVoltage - minVoltage)) * 100;
            //     percentage = Math.max(0, Math.min(100, percentage)); // Ensure percentage is between 0 and 100
            //     return percentage.toFixed(2); // Format to 2 decimal places
            // }
            
            function calculatePercentage(voltage) {
                const minVoltage = 2.6;
                const maxVoltage = 3.5;
                let percentage = Math.trunc(((voltage - minVoltage) / (maxVoltage - minVoltage)*100)/10)*10;
                console.log(percentage)
                percentage = Math.max(0, Math.min(100, percentage)); // Ensure percentage is between 0 and 100
                return percentage;
            }
            
            function updateData(pju) {
                let url;
                switch (pju) {
                    case 'pju1':
                        url = '{{ route('pju.getdata1') }}';
                        break;
                    case 'pju2':
                        url = '{{ route('pju.getdata2') }}';
                        break;
                    case 'pju3':
                        url = '{{ route('pju.getdata3') }}';
                        break;
                    case 'pju4':
                        url = '{{ route('pju.getdata4') }}';
                        break;
                    case 'pju5':
                        url = '{{ route('pju.getdata5') }}';
                        break;
                    case 'all':
                        url = '{{ route('pju.getdata') }}';
                        break;
                }

                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function (data) {
                        const { daya, daya_harian, daya_total, profit_harian, profit_total, bebas_emisi } = data;
                        $('#daya').text((daya).toFixed(2) + ' W');
                        $('#daya_harian').text((daya_harian).toFixed(2) + ' kWh');
                        $('#daya_total').text((daya_total).toFixed(2) + ' kWh');
                        $('#profit_harian').text((profit_harian).toFixed(2) + ' IDR');
                        $('#profit_total').text((profit_total).toFixed(2) + ' IDR');
                        $('#emisi').text((bebas_emisi).toFixed(2) + ' Kg');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error("Failed to fetch data: " + textStatus, errorThrown);
                    }
                });

                updateVoltagePJU(
                    url,
                    '#pju-voltage',
                    '#pju-percentage',
                    ['#pju .bar1', '#pju .bar2', '#pju .bar3', '#pju .bar4']
                );
                
            }

            function updateVoltagePJU(url, voltageSelector, percentageSelector, barSelectors) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        const voltage = data.voltage;
                        const percentage = calculatePercentage(voltage);
                        $(voltageSelector).text(voltage + ' V');
                        $(percentageSelector).text(percentage + '%');
                        
                        // Update battery bars based on percentage
                        const bars = barSelectors.map(selector => $(selector));
                        bars.forEach((bar, index) => {
                            if (percentage >= (index + 0.1) * 25) {
                                bar.show();
                            } else {
                                bar.hide();
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Failed to fetch voltage data: " + textStatus, errorThrown);
                    }
                });
            }

            function updateVoltagePJU1() {
                updateVoltagePJU(
                    '{{ route('pju.getdata1') }}',
                    '#pju1-voltage',
                    '#pju1-percentage',
                    ['#pju1 .bar1', '#pju1 .bar2', '#pju1 .bar3', '#pju1 .bar4']
                );
            }

            function updateVoltagePJU2() {
                updateVoltagePJU(
                    '{{ route('pju.getdata2') }}',
                    '#pju2-voltage',
                    '#pju2-percentage',
                    ['#pju2 .bar1', '#pju2 .bar2', '#pju2 .bar3', '#pju2 .bar4']
                );
            }

            function updateVoltagePJU3() {
                updateVoltagePJU(
                    '{{ route('pju.getdata3') }}',
                    '#pju3-voltage',
                    '#pju3-percentage',
                    ['#pju3 .bar1', '#pju3 .bar2', '#pju3 .bar3', '#pju3 .bar4']
                );
            }

            function updateVoltagePJU4() {
                updateVoltagePJU(
                    '{{ route('pju.getdata4') }}',
                    '#pju4-voltage',
                    '#pju4-percentage',
                    ['#pju4 .bar1', '#pju4 .bar2', '#pju4 .bar3', '#pju4 .bar4']
                );
            }

            function updateVoltagePJU5() {
                updateVoltagePJU(
                    '{{ route('pju.getdata5') }}',
                    '#pju5-voltage',
                    '#pju5-percentage',
                    ['#pju5 .bar1', '#pju5 .bar2', '#pju5 .bar3', '#pju5 .bar4']
                );
            }

            $(document).ready(function() {
                $('.pju-filter-btn').click(function () {
                    const pju = $(this).data('pju');
                    updateData(pju);
                });
                
            $('.pju-filter-btn').click(function() {
                $('.pju-filter-btn').removeClass('bg-blue-500 text-white').addClass('bg-gray-200 text-gray-800');
                $(this).removeClass('bg-gray-200 text-gray-800').addClass('bg-blue-500 text-white');
            });
            
            
            $('.pju-filter-btn[data-pju="all"]').addClass('bg-blue-500 text-white');

                setInterval(updateData, 60000);
                setInterval(updateVoltagePJU1, 60000);
                setInterval(updateVoltagePJU2, 60000);
                setInterval(updateVoltagePJU3, 60000);
                setInterval(updateVoltagePJU4, 60000);
                setInterval(updateVoltagePJU5, 60000);
                updateData('all'); // Panggil sekali saat halaman pertama kali dimuat
            });

            document.getElementById('export-btn').addEventListener('click', function () {
                window.location.href = '{{ route('export.csv') }}';
            });
        });
    </script>
</x-layout>
