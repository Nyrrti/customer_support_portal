<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\Note;
use App\Models\Reply;


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

            $ticket = Ticket::factory()
                ->for($user, "createdBy")
                ->for($admin, "assignedTo")
                ->for($category)
                ->create();

            Reply::factory()
                ->count(rand(0, 3))
                ->for($ticket)
                ->for($admin, "user")
                ->create();

            Note::factory()
                ->count(rand(0, 2))
                ->for($ticket)
                ->for($admin, "user")
                ->create();
        }
    }
}
