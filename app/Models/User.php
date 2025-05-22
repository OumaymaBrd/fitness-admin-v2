<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login_at',
        'phone',
        'birthdate',
        'gender',
        'address',
        'bio',
        'height',
        'weight',
        'fitness_goal',
        'activity_level',
        'preferred_activities',
        'medical_conditions',
        'dietary_restrictions',
        'profile_photo',
        'email_notifications',
        'push_notifications',
        'workout_reminders',
        'achievement_notifications',
        'newsletter',
        'theme',
        'language',
        'units',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'birthdate' => 'date',
    ];

    /**
     * Update the last login timestamp.
     *
     * @return bool
     */
    public function updateLastLoginAt()
    {
        $this->last_login_at = Carbon::now();
        return $this->save();
    }
    
    /**
     * Set the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        // Ne hacher le mot de passe que s'il n'est pas déjà haché
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    /**
     * Get the URL to the user's profile.
     *
     * @return string
     */
    public function adminlte_profile_url()
    {
        return route('profile.edit');
    }

    /**
     * Get the user's profile image.
     *
     * @return string
     */
    public function adminlte_image()
    {
        if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
            return Storage::url($this->profile_photo);
        }
        
        // Image par défaut
        return 'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg';
    }

    /**
     * Get the user's description.
     *
     * @return string
     */
    public function adminlte_desc()
    {
        return 'Membre depuis ' . $this->created_at->format('M. Y');
    }
}