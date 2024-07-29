@extends('admin.layout.main')

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">hotel</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Hotels</p>
                        <h4 class="mb-0">{{ $totalHotels }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">format_list_numbered</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Criteria</p>
                        <h4 class="mb-0">{{ $totalCriteria }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">alternate_email</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Alternatives</p>
                        <h4 class="mb-0">{{ $totalAlternatives }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Total Users</p>
                        <h4 class="mb-0">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-light shadow-light border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-bars-alternatives" class="chart-canvas" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0">Ranking Hotel Recommendations</h6>
                    <p class="text-sm">Berbasis Metode SAW</p>
                    <hr class="dark horizontal">
                    <div class="d-flex">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"><a href="{{ route('alternatives.index') }}">Updated live</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-lg-12 col-md-12 mt-4 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                    <div class="bg-gradient-light shadow-light border-radius-lg py-3 pe-1">
                        <div class="chart">
                            <canvas id="chart-bars-rankings" class="chart-canvas" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0">Ranking Hotel Recommendations</h6>
                    <p class="text-sm">Berbasis Metode AHP</p>
                    <hr class="dark horizontal">
                    <div class="d-flex">
                        <i class="material-icons text-sm my-auto me-1">schedule</i>
                        <p class="mb-0 text-sm"><a href="{{ route('rankings.index') }}">Updated live</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>    


@section('script')
$(document).ready(function() {
    @if(isset($alternatives) && count($alternatives) > 0)
        let alternatives = @json($alternatives);

        function shortenHotelName(name) {
            if (name.length > 10) {
                return name.substring(0, 10) + '...';
            }
            return name;
        }

        function getFullHotelName(hotelName) {
            return hotelName;
        }

        // Prepare data for the alternatives chart
        let alternativesChartData = {
            labels: alternatives.map(alternative => shortenHotelName(alternative.hotel.nama)),
            datasets: [{
                label: "Alternative Scores",
                data: alternatives.map(alternative => alternative.nilai),
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }]
        };

        alternativesChartData.datasets[0].backgroundColor = alternatives.map(alternative => {
            if (alternative.nilai >= 0.7) {
                return 'rgba(75, 192, 192, 0.6)'; // Green
            } else if (alternative.nilai >= 0.6) {
                return 'rgba(255, 206, 86, 0.6)'; // Yellow
            } else {
                return 'rgba(255, 99, 132, 0.6)'; // Red
            }
        });

        alternativesChartData.datasets[0].borderColor = alternatives.map(alternative => {
            if (alternative.nilai >= 0.7) {
                return 'rgba(75, 192, 192, 1)'; // Green
            } else if (alternative.nilai >= 0.6) {
                return 'rgba(255, 206, 86, 1)'; // Yellow
            } else {
                return 'rgba(255, 99, 132, 1)'; // Red
            }
        });

        // Render alternatives chart
        let ctxBarsAlternatives = document.getElementById("chart-bars-alternatives").getContext("2d");
        new Chart(ctxBarsAlternatives, {
            type: "bar",
            data: alternativesChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItem) {
                                let dataIndex = tooltipItem[0].dataIndex;
                                return getFullHotelName(alternatives[dataIndex].hotel.nama);
                            }
                        }
                    }
                }
            }
        });
    @endif

    @if(isset($rankings) && count($rankings) > 0)
        let rankings = @json($rankings);

        // Prepare data for the rankings chart
        let rankingsChartData = {
            labels: rankings.map(ranking => shortenHotelName(ranking.alternative.hotel.nama)),
            datasets: [{
                label: "Ranking Scores",
                data: rankings.map(ranking => ranking.score),
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }]
        };

        rankingsChartData.datasets[0].backgroundColor = rankings.map(ranking => {
            if (ranking.score >= 0.15) {
                return 'rgba(75, 192, 192, 0.6)'; // Green
            } else if (ranking.score >= 0.13) {
                return 'rgba(255, 206, 86, 0.6)'; // Yellow
            } else {
                return 'rgba(255, 99, 132, 0.6)'; // Red
            }
        });

        rankingsChartData.datasets[0].borderColor = rankings.map(ranking => {
            if (ranking.score >= 0.15) {
                return 'rgba(75, 192, 192, 1)'; // Green
            } else if (ranking.score >= 0.13) {
                return 'rgba(255, 206, 86, 1)'; // Yellow
            } else {
                return 'rgba(255, 99, 132, 1)'; // Red
            }
        });

        // Render rankings chart
        let ctxBarsRankings = document.getElementById("chart-bars-rankings").getContext("2d");
        new Chart(ctxBarsRankings, {
            type: "bar",
            data: rankingsChartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItem) {
                                let dataIndex = tooltipItem[0].dataIndex;
                                return getFullHotelName(rankings[dataIndex].alternative.hotel.nama);
                            }
                        }
                    }
                }
            }
        });
    @endif
});
@endsection
@endsection
