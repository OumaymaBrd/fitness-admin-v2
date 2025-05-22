@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <!-- Info boxes -->
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Utilisateurs</span>
                    <span class="info-box-number">{{ $totalUsers }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-check"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Utilisateurs actifs</span>
                    <span class="info-box-number">{{ $activeUsers }}</span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dumbbell"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Programmes</span>
                    <span class="info-box-number">{{ $totalPrograms }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-running"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Exercices</span>
                    <span class="info-box-number">{{ $totalExercises }}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-8">
            <!-- LINE CHART -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Croissance des utilisateurs</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="userGrowthChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Activité des utilisateurs par jour</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="userActivityChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
            <!-- /.card -->

            <!-- TABLE: LATEST USERS -->
            <div class="card">
                <div class="card-header border-transparent">
                    <h3 class="card-title">Utilisateurs récents</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Utilisateur</th>
                                    <th>Email</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td><a href="users/{{ $user['id'] }}">{{ $user['id'] }}</a></td>
                                    <td>{{ $user['name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['date'] }}</td>
                                    <td>
                                        @if($user['status'] == 'Actif')
                                            <span class="badge badge-success">{{ $user['status'] }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $user['status'] }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="users/create" class="btn btn-sm btn-info float-left">Ajouter un utilisateur</a>
                    <a href="users" class="btn btn-sm btn-secondary float-right">Voir tous les utilisateurs</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <!-- DONUT CHART -->
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Utilisation des programmes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="programUsageChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PRODUCT LIST -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Programmes populaires</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($popularPrograms as $program)
                        <li class="item">
                            <div class="product-img">
                                <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Program Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="programs/{{ $program['id'] }}" class="product-title">{{ $program['name'] }}
                                    <span class="badge badge-warning float-right">{{ $program['rating'] }}</span>
                                </a>
                                <span class="product-description">
                                    {{ $program['users'] }} utilisateurs inscrits
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="programs" class="uppercase">Voir tous les programmes</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            <!-- RECENT ACTIVITY -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Activités récentes</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">
                        @foreach($recentActivities as $activity)
                        <li class="item">
                            <div class="product-img">
                                <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="User Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">{{ $activity['user'] }}
                                    @if($activity['type'] == 'program')
                                        <span class="badge badge-success float-right">Programme</span>
                                    @elseif($activity['type'] == 'subscription')
                                        <span class="badge badge-info float-right">Abonnement</span>
                                    @elseif($activity['type'] == 'goal')
                                        <span class="badge badge-warning float-right">Objectif</span>
                                    @elseif($activity['type'] == 'exercise')
                                        <span class="badge badge-primary float-right">Exercice</span>
                                    @endif
                                </a>
                                <span class="product-description">
                                    {{ $activity['action'] }}
                                </span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">Voir toutes les activités</a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop

@section('css')
    <style>
        .info-box .info-box-icon {
            font-size: 1.5rem;
        }
        
        .products-list .product-img {
            float: left;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .products-list .product-info {
            margin-left: 60px;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            // User Growth Chart
            var userGrowthCanvas = document.getElementById('userGrowthChart').getContext('2d');
            var userGrowthChart = new Chart(userGrowthCanvas, {
                type: 'line',
                data: {
                    labels: {!! json_encode($userGrowth['labels']) !!},
                    datasets: [{
                        label: 'Nouveaux utilisateurs',
                        data: {!! json_encode($userGrowth['data']) !!},
                        backgroundColor: 'rgba(60,141,188,0.2)',
                        borderColor: 'rgba(60,141,188,1)',
                        pointRadius: 4,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: true
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            
            // Program Usage Chart
            var programUsageCanvas = document.getElementById('programUsageChart').getContext('2d');
            var programUsageChart = new Chart(programUsageCanvas, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($programUsage['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($programUsage['data']) !!},
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc'],
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                }
            });
            
            // User Activity Chart
            var userActivityCanvas = document.getElementById('userActivityChart').getContext('2d');
            var userActivityChart = new Chart(userActivityCanvas, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($userActivity['labels']) !!},
                    datasets: [{
                        label: 'Activités par jour',
                        data: {!! json_encode($userActivity['data']) !!},
                        backgroundColor: 'rgba(0, 166, 90, 0.8)',
                        borderColor: 'rgba(0, 166, 90, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: true
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: true
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            
            // Initialize DataTables
            $('.table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@stop