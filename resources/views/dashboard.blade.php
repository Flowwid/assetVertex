<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="#" id="downloadCharts" class="text-sm hover:text-gray-700 btn btn-primary">Export Chart</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <canvas id="assetChart"></canvas>
                </div>
                <div>
                    <canvas id="budgetChart"></canvas>
                </div>
            </div>
            <div class="mt-8">
                <canvas id="eventChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Asset data
            var assets = @json($assets); // Convert PHP array to JavaScript array
            var assetLabels = assets.map(asset => asset.name);
            var assetData = assets.map(asset => asset.bom_count);

            var assetCtx = document.getElementById('assetChart').getContext('2d');
            var assetChart = new Chart(assetCtx, {
                type: 'bar',
                data: {
                    labels: assetLabels,
                    datasets: [{
                        label: 'Number of BOMs',
                        data: assetData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Budget data
            var budgets = @json($budgets); // Convert PHP array to JavaScript array
            var budgetLabels = budgets.map(budget => budget.year);
            var budgetData = budgets.map(budget => budget.nominal);

            var budgetCtx = document.getElementById('budgetChart').getContext('2d');
            var budgetChart = new Chart(budgetCtx, {
                type: 'line',
                data: {
                    labels: budgetLabels,
                    datasets: [{
                        label: 'Budget Nominal',
                        data: budgetData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Event data
            var events = @json($events); 
            var eventLabels = events.map(event => `${event.name} (${event.year})`);
            var eventData = events.map(event => event.nominal);

            var eventCtx = document.getElementById('eventChart').getContext('2d');
            var eventChart = new Chart(eventCtx, {
                type: 'bar',
                data: {
                    labels: eventLabels,
                    datasets: [{
                        label: 'Event Nominal',
                        data: eventData,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
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

            function downloadCombinedChart() {
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                var width = Math.max(assetChart.width, budgetChart.width, eventChart.width);
                var height = assetChart.height + budgetChart.height + eventChart.height;

                canvas.width = width;
                canvas.height = height;

                ctx.fillStyle = 'white';
                ctx.fillRect(0, 0, width, height);

                ctx.drawImage(assetChart.canvas, 0, 0);
                ctx.drawImage(budgetChart.canvas, 0, assetChart.height);
                ctx.drawImage(eventChart.canvas, 0, assetChart.height + budgetChart.height);

                var link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'CombinedChart.png';
                link.click();
            }

            document.getElementById('downloadCharts').addEventListener('click', downloadCombinedChart);
        });
    </script>
</x-app-layout>
