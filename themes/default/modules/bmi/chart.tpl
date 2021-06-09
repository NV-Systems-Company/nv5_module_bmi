<!-- BEGIN: main -->
    <!-- BEGIN: data -->
    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script>

        const datapoints = [<!-- BEGIN: score -->'{DATA.score}',<!-- END: score -->];
        const data = {
            labels: [<!-- BEGIN: addtime -->'{DATA.addtime}',<!-- END: addtime -->],
            datasets: [
                {
                    label: 'BMI',
                    data: datapoints,
                    borderColor: '#006c70',
                    fill: false,
                    cubicInterpolationMode: 'monotone',
                    tension: 0.4
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Bảng theo dõi chỉ số BMI của bạn {USER.fullname}'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Thời gian kiểm tra'
                        }
                    },
                    y: {
                        display: true,
                        suggestedMin: 0,
                        title: {
                            display: true,
                            text: 'Chỉ số'
                        }
                    }
                }
            },
        };
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <!-- END: data -->
<!-- END: main -->