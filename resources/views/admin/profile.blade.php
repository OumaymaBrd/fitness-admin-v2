@extends('adminlte::page')

@section('title', 'Profil')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Profil utilisateur</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                    <p class="text-muted text-center">Administrateur</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Membre depuis</b> <a class="float-right">{{ Auth::user()->created_at->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dernière connexion</b> <a class="float-right">{{ now()->format('d/m/Y H:i') }}</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block"><b>Modifier la photo</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">À propos de moi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-book mr-1"></i> Éducation</strong>
                    <p class="text-muted">
                        Diplôme en informatique
                    </p>
                    <hr>
                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Localisation</strong>
                    <p class="text-muted">Paris, France</p>
                    <hr>
                    <strong><i class="fas fa-pencil-alt mr-1"></i> Compétences</strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">UI Design</span>
                        <span class="tag tag-success">Coding</span>
                        <span class="tag tag-info">Javascript</span>
                        <span class="tag tag-warning">PHP</span>
                        <span class="tag tag-primary">Node.js</span>
                    </p>
                    <hr>
                    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                    <p class="text-muted">Administrateur principal de la plateforme fitness.</p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Paramètres</a></li>
                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Mot de passe</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activité</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Nom</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" placeholder="Nom" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPhone" placeholder="Téléphone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputExperience" class="col-sm-2 col-form-label">Expérience</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Expérience"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Compétences</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Compétences">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Je suis d'accord avec les <a href="#">conditions</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        
                        <div class="tab-pane" id="password">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="currentPassword" class="col-sm-3 col-form-label">Mot de passe actuel</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="currentPassword" placeholder="Mot de passe actuel">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Nouveau mot de passe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirmPassword" class="col-sm-3 col-form-label">Confirmer mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmer mot de passe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        
                        <div class="tab-pane" id="activity">
                            <!-- The timeline -->
                            <div class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-danger">
                                        {{ now()->format('d M. Y') }}
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-envelope bg-primary"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Support Team</a> vous a envoyé un email</h3>
                                        <div class="timeline-body">
                                            Bienvenue sur la plateforme d'administration Fitness !
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm">Lire plus</a>
                                            <a href="#" class="btn btn-danger btn-sm">Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-user bg-info"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> a accepté votre invitation</h3>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-comments bg-warning"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                        <h3 class="timeline-header"><a href="#">Jay White</a> a commenté sur votre post</h3>
                                        <div class="timeline-body">
                                            Excellent programme de fitness, merci pour le partage !
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-warning btn-flat btn-sm">Voir commentaire</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <div class="time-label">
                                    <span class="bg-success">
                                        {{ now()->subDays(3)->format('d M. Y') }}
                                    </span>
                                </div>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> a téléchargé de nouvelles photos</h3>
                                        <div class="timeline-body">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                            <img src="https://placehold.it/150x100" alt="...">
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@stop

@section('css')
    <style>
        .timeline {
            margin: 0;
            padding: 0;
            position: relative;
        }
        
        .timeline:before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #ddd;
            left: 31px;
            margin: 0;
            border-radius: 2px;
        }
        
        .timeline > div {
            margin-right: 10px;
            margin-left: 60px;
            margin-bottom: 15px;
            position: relative;
        }
        
        .timeline > div > i {
            width: 30px;
            height: 30px;
            font-size: 15px;
            line-height: 30px;
            position: absolute;
            color: #fff;
            background: #d2d6de;
            border-radius: 50%;
            text-align: center;
            left: -60px;
            top: 0;
        }
        
        .timeline-item {
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 3px;
            margin-top: 0;
            background: #fff;
            color: #444;
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            position: relative;
        }
        
        .timeline-item .time {
            color: #999;
            float: right;
            padding: 10px;
            font-size: 12px;
        }
        
        .timeline-item .timeline-header {
            margin: 0;
            color: #555;
            border-bottom: 1px solid #f4f4f4;
            padding: 10px;
            font-size: 16px;
            line-height: 1.1;
        }
        
        .timeline-item .timeline-body {
            padding: 10px;
        }
        
        .timeline-item .timeline-footer {
            padding: 10px;
        }
        
        .time-label {
            padding-left: 60px;
            margin-bottom: 15px;
        }
        
        .time-label > span {
            display: inline-block;
            padding: 5px 10px;
            color: #fff;
            border-radius: 3px;
        }
        
        .tag {
            display: inline-block;
            padding: 2px 5px;
            margin-right: 5px;
            border-radius: 3px;
            background-color: #3c8dbc;
            color: #fff;
        }
        
        .tag.tag-danger {
            background-color: #dd4b39;
        }
        
        .tag.tag-success {
            background-color: #00a65a;
        }
        
        .tag.tag-info {
            background-color: #00c0ef;
        }
        
        .tag.tag-warning {
            background-color: #f39c12;
        }
        
        .tag.tag-primary {
            background-color: #3c8dbc;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            // Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>
@stop