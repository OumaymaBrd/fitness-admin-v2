<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalUsers = User::count() ?: 1250;
        
        // Vérifier si la colonne last_login_at a des données
        $activeUsers = 0;
        if (Schema::hasColumn('users', 'last_login_at')) {
            $activeUsers = User::whereNotNull('last_login_at')
                ->where('last_login_at', '>=', Carbon::now()->subDays(30))
                ->count();
        }
        
        // Si aucun utilisateur actif n'est trouvé, utiliser une valeur par défaut
        if ($activeUsers == 0) {
            $activeUsers = (int)($totalUsers * 0.7); // Environ 70% des utilisateurs sont actifs
        }
        
        $totalPrograms = 45; // À remplacer par Program::count();
        $totalExercises = 320; // À remplacer par Exercise::count();
        
        // Données pour les graphiques
        $userGrowth = [
            'labels' => ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
            'data' => [65, 80, 110, 150, 210, 240, 280, 320, 350, 400, 450, 500],
        ];
        
        $programUsage = [
            'labels' => ['Musculation', 'Cardio', 'Yoga', 'HIIT', 'Pilates'],
            'data' => [45, 25, 15, 10, 5],
        ];
        
        $userActivity = [
            'labels' => ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            'data' => [30, 25, 35, 40, 45, 55, 40],
        ];
        
        // Utilisateurs récents
        $recentUsers = User::latest()->take(5)->get()->map(function($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'date' => $user->created_at->format('Y-m-d'),
                'status' => $user->last_login_at && $user->last_login_at->gt(Carbon::now()->subDays(30)) ? 'Actif' : 'Inactif'
            ];
        })->toArray();
        
        // Si aucun utilisateur n'est trouvé, utiliser des données fictives
        if (empty($recentUsers)) {
            $recentUsers = [
                ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'date' => '2023-05-20', 'status' => 'Actif'],
                ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com', 'date' => '2023-05-19', 'status' => 'Actif'],
                ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com', 'date' => '2023-05-18', 'status' => 'Inactif'],
                ['id' => 4, 'name' => 'Alice Brown', 'email' => 'alice@example.com', 'date' => '2023-05-17', 'status' => 'Actif'],
                ['id' => 5, 'name' => 'Mike Wilson', 'email' => 'mike@example.com', 'date' => '2023-05-16', 'status' => 'Actif'],
            ];
        }
        
        // Activités récentes
        $recentActivities = [
            ['user' => 'John Doe', 'action' => 'A commencé le programme "Musculation 30 jours"', 'date' => '2023-05-20', 'type' => 'program'],
            ['user' => 'Jane Smith', 'action' => 'A souscrit à l\'abonnement Premium', 'date' => '2023-05-19', 'type' => 'subscription'],
            ['user' => 'Bob Johnson', 'action' => 'A atteint son objectif de poids', 'date' => '2023-05-18', 'type' => 'goal'],
            ['user' => 'Alice Brown', 'action' => 'A terminé 10 exercices aujourd\'hui', 'date' => '2023-05-17', 'type' => 'exercise'],
            ['user' => 'Mike Wilson', 'action' => 'A rejoint le programme "Cardio intensif"', 'date' => '2023-05-16', 'type' => 'program'],
        ];
        
        // Programmes populaires
        $popularPrograms = [
            ['id' => 1, 'name' => 'Musculation 30 jours', 'users' => 450, 'rating' => 4.8],
            ['id' => 2, 'name' => 'Cardio intensif', 'users' => 320, 'rating' => 4.6],
            ['id' => 3, 'name' => 'Yoga pour débutants', 'users' => 280, 'rating' => 4.9],
            ['id' => 4, 'name' => 'HIIT 20 minutes', 'users' => 250, 'rating' => 4.7],
            ['id' => 5, 'name' => 'Pilates avancé', 'users' => 180, 'rating' => 4.5],
        ];
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'totalPrograms',
            'totalExercises',
            'userGrowth',
            'programUsage',
            'userActivity',
            'recentUsers',
            'recentActivities',
            'popularPrograms'
        ));
    }
}