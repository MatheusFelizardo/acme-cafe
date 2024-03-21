<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Breakfast
        DB::table('dishes')->insert([
            [
                'name' => 'Pastel de Nata', 
                'description' => 'Portuguese custard tart', 
                'price' => 1.50, 
                'is_active' => true, 
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tosta Mista', 
                'description' => 'Toasted ham and cheese sandwich', 
                'price' => 3.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pão de Deus', 
                'description' => 'Sweet bread roll with coconut topping', 
                'price' => 1.80, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Queijada', 
                'description' => 'Portuguese cheese tart', 
                'price' => 2.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // Lunch
        DB::table('dishes')->insert([
            [
                'name' => 'Bacalhau à Brás', 
                'description' => 'Shredded cod with onions, potatoes, and eggs', 
                'price' => 8.50, 
                'is_active' => true, 
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now()            
            ],
            [
                'name' => 'Francesinha', 
                'description' => 'Portuguese sandwich with cured meats and melted cheese', 
                'price' => 10.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bifana', 
                'description' => 'Pork sandwich with spicy sauce', 
                'price' => 6.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sopa de Legumes', 
                'description' => 'Vegetable soup', 
                'price' => 4.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Dinner
        DB::table('dishes')->insert([
            [
                'name' => 'Caldo Verde', 
                'description' => 'Traditional Portuguese soup made with kale, potatoes, and chorizo', 
                'price' => 6.00, 
                'is_active' => true, 
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now()            
            ],
            [
                'name' => 'Arroz de Marisco', 
                'description' => 'Portuguese seafood rice', 
                'price' => 12.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Carne de Porco à Alentejana', 
                'description' => 'Pork with clams', 
                'price' => 10.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bacalhau com Natas', 
                'description' => 'Cod with cream', 
                'price' => 9.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Dessert
        DB::table('dishes')->insert([
            [
                'name' => 'Bolo de Bolacha', 
                'description' => 'Portuguese biscuit cake', 
                'price' => 4.50, 
                'is_active' => true, 
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now()            
            ],
            [
                'name' => 'Tarte de Amêndoa', 
                'description' => 'Almond tart', 
                'price' => 5.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pudim Flan', 
                'description' => 'Caramel custard', 
                'price' => 3.50, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mousse de Chocolate', 
                'description' => 'Chocolate mousse', 
                'price' => 4.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Drinks
        DB::table('dishes')->insert([
            [
                'name' => 'Espresso', 
                'description' => 'Strong black coffee brewed by forcing hot water through finely-ground coffee beans',
                'price' => 0.70, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Café Americano', 
                'description' => 'Espresso with added hot water', 
                'price' => 1.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Café com Leite', 
                'description' => 'Coffee with milk', 
                'price' => 1.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Galão', 
                'description' => 'Portuguese latte', 
                'price' => 1.00, 
                'is_active' => true, 
                'featured' => true
,
                'created_at' => now(),
                'updated_at' => now()            ],
            [
                'name' => 'Suco Natural', 
                'description' => 'Juice of the day.  Check the available options with the waiter.', 
                'price' => 2.50, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cerveja Superbock Pint', 
                'description' => 'Superbock Beer 500ml', 
                'price' => 3.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Vinho Verde', 
                'description' => 'Green wine', 
                'price' => 4.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cappuccino', 
                'description' => 'Espresso mixed with steamed milk and topped with foam', 
                'price' => 1.50, 
                'is_active' => true, 
                'featured' => true,
                'created_at' => now(),
                'updated_at' => now()            
            ],
            [
                'name' => 'Chá natural', 
                'description' => 'A selection of fine teas. Check the available options with the waiter.', 
                'price' => 1.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Água', 
                'description' => 'Still or sparkling mineral water', 
                'price' => 1.00, 
                'is_active' => true, 
                'featured' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('food_categories')->insert([
            ['name' => 'Breakfast'],
            ['name' => 'Lunch'],
            ['name' => 'Dinner'],
            ['name' => 'Dessert'],
            ['name' => 'Drinks'],
        ]);

        $breakfastDishes = [1, 2, 3, 4];
        $this->attachCategoryToDishes($breakfastDishes, 1); // 1 is the ID for Breakfast category

        $lunchDishes = [5, 6, 7, 8];
        $this->attachCategoryToDishes($lunchDishes, 2); // 2 is the ID for Lunch category

        $dinnerDishes = [9, 10, 11, 12];
        $this->attachCategoryToDishes($dinnerDishes, 3); // 3 is the ID for Dinner category

        $dessertDishes = [13, 14, 15, 16];
        $this->attachCategoryToDishes($dessertDishes, 4); // 4 is the ID for Dessert category

        $drinkDishes = [17, 18, 19, 20, 21, 22, 23, 24, 25, 26];
        $this->attachCategoryToDishes($drinkDishes, 5); // 5 is the ID for Drinks category
    }

        /**
     * Attach category to dishes.
     *
     * @param array $dishIds
     * @param int $categoryId
     * @return void
     */
    private function attachCategoryToDishes(array $dishIds, int $categoryId)
    {
        foreach ($dishIds as $dishId) {
            DB::table('dish_category')->insert([
                'food_category_id' => $categoryId,
                'dish_id' => $dishId,
            ]);
        }
    }
}
