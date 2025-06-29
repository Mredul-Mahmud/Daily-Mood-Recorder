<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mood Counts (Last 7 Days)</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Mood Entries in the Last 7 Days</h1>

    <canvas id="moodChart" width="300" height="200"></canvas>

    <script>
        const ctx = document.getElementById('moodChart').getContext('2d');

        const moodChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_map('ucfirst', array_keys($counts))) !!},
                datasets: [{
                    label: 'Number of Entries',
                    data: {!! json_encode(array_values($counts)) !!},
                    

                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        title: {
                            display: true,
                            text: 'Number of Entries'
                        }
                    }
                }
            }
        });
    </script>

    <br>
    <a href="{{ route('dashboard') }}">
        <button type="button">Back to Dashboard</button>
    </a>
</body>
</html>
