<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
        });
    </script>
</x-app-layout>
