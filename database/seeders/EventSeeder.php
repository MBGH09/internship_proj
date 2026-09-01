<?php

namespace Database\Seeders;

// Importe les models
use App\Models\mb_Event;
use App\Models\mb_User;
use App\Models\mb_Category;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    // Crée des événements de test
    public function run(): void
    {
        // Récupère l'admin
        $admin = mb_User::where('mb_email', 'admin@example.com')->first();
        
        // Récupère les catégories
        $categories = mb_Category::all();
        
        // Données des événements de test
        $eventsData = [
            [
                'mb_title' => 'Marathon 2026',
                'mb_description' => 'Un grand marathon dans la ville.',
                'mb_start_date' => '2026-02-15 08:00:00',
                'mb_end_date' => '2026-02-15 12:00:00',
                'mb_place' => 'Parc Municipal',
                'mb_price' => 0,
                'mb_capacity' => 100,
                'mb_category_id' => $categories->first(fn($c) => $c->mb_cat_name === 'Sport')->mb_cat_id,
            ],
            [
                'mb_title' => 'Conférence IA',
                'mb_description' => 'Découvrez les dernières tendances en Intelligence Artificielle.',
                'mb_start_date' => '2026-03-20 14:00:00',
                'mb_end_date' => '2026-03-20 17:00:00',
                'mb_place' => 'Centre de Conférences',
                'mb_price' => 50,
                'mb_capacity' => 200,
                'mb_category_id' => $categories->first(fn($c) => $c->mb_cat_name === 'Conférence')->mb_cat_id,
            ],
            [
                'mb_title' => 'Concert Jazz',
                'mb_description' => 'Une soirée de jazz en live avec les meilleurs artistes.',
                'mb_start_date' => '2026-04-10 20:00:00',
                'mb_end_date' => '2026-04-10 23:00:00',
                'mb_place' => 'Auditorium Principal',
                'mb_price' => 75,
                'mb_capacity' => 300,
                'mb_category_id' => $categories->first(fn($c) => $c->mb_cat_name === 'Concert')->mb_cat_id,
            ],
        ];
        
        // Crée les événements
        foreach ($eventsData as $eventData) {
            mb_Event::create([
                ...$eventData,
                'mb_created_by' => $admin->mb_id,
                'mb_is_free' => $eventData['mb_price'] == 0,
                'mb_is_active' => true,
            ]);
        }
        
        // Affiche un message dans la console
        echo "✅ " . count($eventsData) . " événements créés!\n";
    }
}