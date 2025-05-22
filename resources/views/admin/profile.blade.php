@extends('adminlte::page')

@section('title', 'Profil Utilisateur')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Profil Utilisateur</h1>
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
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Succès!</h5>
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Erreur!</h5>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" 
                             src="{{ Auth::user()->adminlte_image() }}" 
                             alt="Photo de profil">
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">
                        @if(Auth::user()->role == 'admin')
                            Administrateur
                        @elseif(Auth::user()->role == 'coach')
                            Coach
                        @else
                            Membre
                        @endif
                    </p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Membre depuis</b> <a class="float-right">{{ Auth::user()->created_at->format('d/m/Y') }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Dernière connexion</b> <a class="float-right">{{ Auth::user()->last_login_at ? Auth::user()->last_login_at->format('d/m/Y H:i') : 'Jamais' }}</a>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-upload-photo">
                        <i class="fas fa-camera mr-2"></i> Changer la photo
                    </button>
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
                    <strong><i class="fas fa-dumbbell mr-1"></i> Objectif Fitness</strong>
                    <p class="text-muted">
                        Perte de poids et renforcement musculaire
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Localisation</strong>
                    <p class="text-muted">Paris, France</p>

                    <hr>

                    <strong><i class="fas fa-pencil-alt mr-1"></i> Activités préférées</strong>
                    <p class="text-muted">
                        <span class="tag tag-danger">Musculation</span>
                        <span class="tag tag-success">Course à pied</span>
                        <span class="tag tag-info">Yoga</span>
                        <span class="tag tag-warning">HIIT</span>
                        <span class="tag tag-primary">Natation</span>
                    </p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Bio</strong>
                    <p class="text-muted">
                        Passionné de fitness et de nutrition, je m'entraîne régulièrement pour atteindre mes objectifs de santé et de bien-être.
                    </p>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- Fitness Stats Box -->
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Statistiques Fitness</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-success text-xl">
                            <i class="fas fa-running"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                85
                            </span>
                            <span class="text-muted">Séances d'entraînement</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                        <p class="text-warning text-xl">
                            <i class="fas fa-fire-alt"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                42,500
                            </span>
                            <span class="text-muted">Calories brûlées</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
                    <div class="d-flex justify-content-between align-items-center mb-0">
                        <p class="text-danger text-xl">
                            <i class="fas fa-heart"></i>
                        </p>
                        <p class="d-flex flex-column text-right">
                            <span class="font-weight-bold">
                                65 bpm
                            </span>
                            <span class="text-muted">Fréquence cardiaque moyenne</span>
                        </p>
                    </div>
                    <!-- /.d-flex -->
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
                        <li class="nav-item"><a class="nav-link active" href="#personal-info" data-toggle="tab">Informations personnelles</a></li>
                        <li class="nav-item"><a class="nav-link" href="#fitness-data" data-toggle="tab">Données fitness</a></li>
                        <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Mot de passe</a></li>
                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activité</a></li>
                        <li class="nav-item"><a class="nav-link" href="#preferences" data-toggle="tab">Préférences</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Personal Info Tab -->
                        <div class="active tab-pane" id="personal-info">
                            <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nom complet</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom complet" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone" value="{{ Auth::user()->phone ?? '' }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="birthdate" class="col-sm-2 col-form-label">Date de naissance</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ Auth::user()->birthdate ?? '' }}">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="gender" class="col-sm-2 col-form-label">Genre</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">Sélectionner</option>
                                            <option value="male" {{ (Auth::user()->gender ?? '') == 'male' ? 'selected' : '' }}>Homme</option>
                                            <option value="female" {{ (Auth::user()->gender ?? '') == 'female' ? 'selected' : '' }}>Femme</option>
                                            <option value="other" {{ (Auth::user()->gender ?? '') == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Adresse</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" name="address" rows="3" placeholder="Adresse">{{ Auth::user()->address ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="bio" class="col-sm-2 col-form-label">Bio</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="bio" name="bio" rows="3" placeholder="Parlez-nous de vous">{{ Auth::user()->bio ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- Fitness Data Tab -->
                        <div class="tab-pane" id="fitness-data">
                            <form class="form-horizontal" method="POST" action="{{ route('profile.update.fitness') }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="height">Taille (cm)</label>
                                            <input type="number" class="form-control" id="height" name="height" placeholder="Taille en cm" value="{{ Auth::user()->height ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="weight">Poids (kg)</label>
                                            <input type="number" step="0.1" class="form-control" id="weight" name="weight" placeholder="Poids en kg" value="{{ Auth::user()->weight ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="fitness_goal">Objectif principal</label>
                                    <select class="form-control" id="fitness_goal" name="fitness_goal">
                                        <option value="">Sélectionner un objectif</option>
                                        <option value="weight_loss" {{ (Auth::user()->fitness_goal ?? '') == 'weight_loss' ? 'selected' : '' }}>Perte de poids</option>
                                        <option value="muscle_gain" {{ (Auth::user()->fitness_goal ?? '') == 'muscle_gain' ? 'selected' : '' }}>Prise de masse musculaire</option>
                                        <option value="endurance" {{ (Auth::user()->fitness_goal ?? '') == 'endurance' ? 'selected' : '' }}>Amélioration de l'endurance</option>
                                        <option value="flexibility" {{ (Auth::user()->fitness_goal ?? '') == 'flexibility' ? 'selected' : '' }}>Amélioration de la flexibilité</option>
                                        <option value="general_fitness" {{ (Auth::user()->fitness_goal ?? '') == 'general_fitness' ? 'selected' : '' }}>Forme physique générale</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="activity_level">Niveau d'activité</label>
                                    <select class="form-control" id="activity_level" name="activity_level">
                                        <option value="">Sélectionner un niveau</option>
                                        <option value="sedentary" {{ (Auth::user()->activity_level ?? '') == 'sedentary' ? 'selected' : '' }}>Sédentaire (peu ou pas d'exercice)</option>
                                        <option value="light" {{ (Auth::user()->activity_level ?? '') == 'light' ? 'selected' : '' }}>Légèrement actif (exercice léger 1-3 jours/semaine)</option>
                                        <option value="moderate" {{ (Auth::user()->activity_level ?? '') == 'moderate' ? 'selected' : '' }}>Modérément actif (exercice modéré 3-5 jours/semaine)</option>
                                        <option value="active" {{ (Auth::user()->activity_level ?? '') == 'active' ? 'selected' : '' }}>Très actif (exercice intense 6-7 jours/semaine)</option>
                                        <option value="extreme" {{ (Auth::user()->activity_level ?? '') == 'extreme' ? 'selected' : '' }}>Extrêmement actif (exercice très intense, travail physique)</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Activités préférées</label>
                                    <div class="select2-purple">
                                        <select class="select2" multiple="multiple" data-placeholder="Sélectionner des activités" data-dropdown-css-class="select2-purple" style="width: 100%;" name="preferred_activities[]">
                                            <option value="running" {{ in_array('running', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Course à pied</option>
                                            <option value="weightlifting" {{ in_array('weightlifting', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Musculation</option>
                                            <option value="yoga" {{ in_array('yoga', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Yoga</option>
                                            <option value="swimming" {{ in_array('swimming', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Natation</option>
                                            <option value="cycling" {{ in_array('cycling', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Cyclisme</option>
                                            <option value="hiit" {{ in_array('hiit', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>HIIT</option>
                                            <option value="pilates" {{ in_array('pilates', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Pilates</option>
                                            <option value="boxing" {{ in_array('boxing', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Boxe</option>
                                            <option value="dance" {{ in_array('dance', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Danse</option>
                                            <option value="basketball" {{ in_array('basketball', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Basketball</option>
                                            <option value="football" {{ in_array('football', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Football</option>
                                            <option value="tennis" {{ in_array('tennis', explode(',', Auth::user()->preferred_activities ?? '')) ? 'selected' : '' }}>Tennis</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="medical_conditions">Conditions médicales</label>
                                    <textarea class="form-control" id="medical_conditions" name="medical_conditions" rows="3" placeholder="Veuillez indiquer toute condition médicale pertinente">{{ Auth::user()->medical_conditions ?? '' }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="dietary_restrictions">Restrictions alimentaires</label>
                                    <textarea class="form-control" id="dietary_restrictions" name="dietary_restrictions" rows="3" placeholder="Veuillez indiquer toute restriction alimentaire">{{ Auth::user()->dietary_restrictions ?? '' }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Enregistrer les données fitness</button>
                                </div>
                            </form>
                            
                            <!-- Weight Progress Chart -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Progression du poids</h3>
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
                                        <canvas id="weightChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        
                        <!-- Password Tab -->
                        <div class="tab-pane" id="password">
                            <form class="form-horizontal" method="POST" action="{{ route('profile.update.password') }}">
                                @csrf
                                @method('PATCH')
                                
                                <div class="form-group row">
                                    <label for="current_password" class="col-sm-3 col-form-label">Mot de passe actuel</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Mot de passe actuel">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="password" class="col-sm-3 col-form-label">Nouveau mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmer mot de passe</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer mot de passe">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-danger">Changer le mot de passe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        
                        <!-- Activity Tab -->
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
                                    <i class="fas fa-dumbbell bg-primary"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Programme Fitness</a> - Séance terminée</h3>
                                        <div class="timeline-body">
                                            Vous avez terminé une séance de "Musculation 30 jours" avec succès !
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm">Voir les détails</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-heart bg-success"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> Hier</span>
                                        <h3 class="timeline-header"><a href="#">Objectif atteint</a> - Félicitations !</h3>
                                        <div class="timeline-body">
                                            Vous avez atteint votre objectif de 10 000 pas quotidiens pendant 7 jours consécutifs.
                                        </div>
                                    </div>
                                </div>
                                <!-- END timeline item -->
                                
                                <!-- timeline item -->
                                <div>
                                    <i class="fas fa-utensils bg-warning"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 2 jours</span>
                                        <h3 class="timeline-header"><a href="#">Plan nutritionnel</a> - Mise à jour</h3>
                                        <div class="timeline-body">
                                            Votre coach a mis à jour votre plan nutritionnel pour la semaine prochaine.
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-warning btn-sm">Voir le plan</a>
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
                                    <i class="fas fa-trophy bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 5 jours</span>
                                        <h3 class="timeline-header"><a href="#">Badge obtenu</a> - Persévérance</h3>
                                        <div class="timeline-body">
                                            Vous avez obtenu le badge "Persévérance" pour avoir complété 30 séances d'entraînement.
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
                        
                        <!-- Preferences Tab -->
                        <div class="tab-pane" id="preferences">
                            <form class="form-horizontal" method="POST" action="{{ route('profile.update.preferences') }}">
                                @csrf
                                @method('PATCH')
                                
                                <h4 class="mt-3 mb-4">Préférences de notification</h4>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="email_notifications" name="email_notifications" {{ (Auth::user()->email_notifications ?? 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="email_notifications">Recevoir des notifications par email</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="push_notifications" name="push_notifications" {{ (Auth::user()->push_notifications ?? 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="push_notifications">Recevoir des notifications push</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="workout_reminders" name="workout_reminders" {{ (Auth::user()->workout_reminders ?? 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="workout_reminders">Rappels d'entraînement</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="achievement_notifications" name="achievement_notifications" {{ (Auth::user()->achievement_notifications ?? 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="achievement_notifications">Notifications d'accomplissement</label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="newsletter" name="newsletter" {{ (Auth::user()->newsletter ?? 0) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="newsletter">S'abonner à la newsletter</label>
                                    </div>
                                </div>
                                
                                <h4 class="mt-4 mb-4">Préférences d'affichage</h4>
                                
                                <div class="form-group">
                                    <label for="theme">Thème</label>
                                    <select class="form-control" id="theme" name="theme">
                                        <option value="light" {{ (Auth::user()->theme ?? 'light') == 'light' ? 'selected' : '' }}>Clair</option>
                                        <option value="dark" {{ (Auth::user()->theme ?? 'light') == 'dark' ? 'selected' : '' }}>Sombre</option>
                                        <option value="system" {{ (Auth::user()->theme ?? 'light') == 'system' ? 'selected' : '' }}>Système</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="language">Langue</label>
                                    <select class="form-control" id="language" name="language">
                                        <option value="fr" {{ (Auth::user()->language ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                                        <option value="en" {{ (Auth::user()->language ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="es" {{ (Auth::user()->language ?? 'fr') == 'es' ? 'selected' : '' }}>Español</option>
                                        <option value="de" {{ (Auth::user()->language ?? 'fr') == 'de' ? 'selected' : '' }}>Deutsch</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="units">Unités de mesure</label>
                                    <select class="form-control" id="units" name="units">
                                        <option value="metric" {{ (Auth::user()->units ?? 'metric') == 'metric' ? 'selected' : '' }}>Métrique (kg, cm)</option>
                                        <option value="imperial" {{ (Auth::user()->units ?? 'metric') == 'imperial' ? 'selected' : '' }}>Impérial (lb, in)</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info">Enregistrer les préférences</button>
                                </div>
                            </form>
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

    <!-- Upload Photo Modal -->
    <div class="modal fade" id="modal-upload-photo">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Changer la photo de profil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="profile_photo">Sélectionner une nouvelle photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profile_photo" name="profile_photo" accept="image/*">
                                    <label class="custom-file-label" for="profile_photo">Choisir un fichier</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="img-preview text-center" style="display: none;">
                                <img id="photo-preview" src="#" alt="Aperçu de la photo" class="img-fluid img-circle" style="max-height: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop

@section('css')
    <style>
        .profile-user-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
        
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
            
            // Initialize BS-Custom-file-input
            bsCustomFileInput.init();
            
            // Preview uploaded image
            $('#profile_photo').change(function() {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#photo-preview').attr('src', event.target.result);
                        $('.img-preview').show();
                    }
                    reader.readAsDataURL(file);
                }
            });
            
            // Weight Progress Chart
            var ctx = document.getElementById('weightChart').getContext('2d');
            var weightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Poids (kg)',
                        data: [85, 84, 82, 80, 79, 78, 77, 76, 75, 74, 73, 72],
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
                                beginAtZero: false
                            }
                        }]
                    }
                }
            });
        });
    </script>
@stop