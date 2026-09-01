<?php

namespace Database\Seeders;

// Importe les models et Hash
use App\Models\mb_User; // Import the mb_User model
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Crée un utilisateur avec le rôle admin (uniquement s'il n'existe pas)
        mb_User::firstOrCreate(
            ['mb_email' => 'admin@example.com'],
            [
                'mb_name' => 'Administrateur',
                'mb_phone' => '+33612345678',
                'mb_password' => Hash::make('password123'),
                'mb_role' => 'admin',
            ]
        );
        
        // Crée un utilisateur de test simple (uniquement s'il n'existe pas)
        mb_User::firstOrCreate(
            ['mb_email' => 'user@example.com'],
            [
                'mb_name' => 'Utilisateur Test',
                'mb_phone' => '+33698765432',
                'mb_password' => Hash::make('password123'),
                'mb_role' => 'user',
            ]
        );
        
        // Affiche un message dans la console
        echo "✅ Admin et utilisateur de test créés!\n";
        echo "Admin: admin@example.com / password123\n";
        echo "User: user@example.com / password123\n";
    }
}