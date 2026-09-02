<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        for ($i=0; $i <  8 ; $i++) { 
            $user = User::where("is_admin", false)
            ->inRandomOrder()
            ->first();

            $admin = User::where("is_admin", true)
            ->inRandomOrder()
            ->first();

            $category = Category::inRandomOrder()
            ->first();

            Ticket::factory()
            ->for($user, "createdBy")
            ->for($admin, "assignedTo")
            ->for($category)
            ->create();
        }
    }
}
