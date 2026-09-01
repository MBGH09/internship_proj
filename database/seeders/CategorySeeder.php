<?php

namespace Database\Seeders;

// Importe le model AaCategory
use App\Models\mb_Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    // Crée les catégories initiales
    public function run(): void
    {
        // Liste des catégories à créer
        $categories = [
            'Sport',
            'Musique',
            'Conférence',
            'Séminaire',
            'Exposition',
            'Concert',
            'Formation',
            'Atelier',
        ];
        
        // Crée chaque catégorie
        foreach ($categories as $categoryName) {
            mb_Category::create([
                'mb_cat_name' => $categoryName,
            ]);
        }
        
        // Affiche un message dans la console
        echo "✅ " . count($categories) . " catégories créées!\n";
    }
}