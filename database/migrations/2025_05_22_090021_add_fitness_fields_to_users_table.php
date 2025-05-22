<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Champs personnels
            $table->string('phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_photo')->nullable();
            
            // Champs fitness
            $table->decimal('height', 5, 2)->nullable(); // en cm
            $table->decimal('weight', 5, 2)->nullable(); // en kg
            $table->string('fitness_goal')->nullable();
            $table->string('activity_level')->nullable();
            $table->text('preferred_activities')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('dietary_restrictions')->nullable();
            
            // Préférences
            $table->boolean('email_notifications')->default(1);
            $table->boolean('push_notifications')->default(1);
            $table->boolean('workout_reminders')->default(1);
            $table->boolean('achievement_notifications')->default(1);
            $table->boolean('newsletter')->default(0);
            $table->string('theme')->default('light');
            $table->string('language')->default('fr');
            $table->string('units')->default('metric');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'birthdate',
                'gender',
                'address',
                'bio',
                'profile_photo',
                'height',
                'weight',
                'fitness_goal',
                'activity_level',
                'preferred_activities',
                'medical_conditions',
                'dietary_restrictions',
                'email_notifications',
                'push_notifications',
                'workout_reminders',
                'achievement_notifications',
                'newsletter',
                'theme',
                'language',
                'units',
            ]);
        });
    }
};