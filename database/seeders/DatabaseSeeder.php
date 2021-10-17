<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;
use App\Models\Industry;
use App\Models\Recyclable;
use App\Models\User;
use App\Models\CollectorRecycle;
use App\Models\Collector;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Predefined UserTypes
        UserType::create([
            "name" => "super_admin"]); 
        UserType::create([
            "name" => "residential"]); 
        UserType::create([
            "name" => "business"]);
        UserType::create([
            "name" => "collector"]);

        //Predefined Industries
        Industry::create([
            "name" => "Medical"]);
        Industry::create([
            "name" => "Retail"]);
        Industry::create([
            "name" => "Education"]);
        Industry::create([
            "name" => "Agriculture"]);
        Industry::create([
            "name" => "Technology"]);  
            
        //Predefined Recyclables
        Recyclable::create([
            "name" => "Plastic"]);
        Recyclable::create([
            "name" => "Glass"]);
        Recyclable::create([
            "name" => "Paper"]);
        Recyclable::create([
            "name" => "Metal"]);
        Recyclable::create([
            "name" => "Cans"]);      
        Recyclable::create([
            "name" => "Electric and Electronics"]); 
        Recyclable::create([
            "name" => "Clothes and Shoes"]);
        Recyclable::create([
            "name" => "Compost"]);
        Recyclable::create([
            "name" => "Tyres"]);  
        Recyclable::create([
            "name" => "Used Cooking Oil"]);
        //Predefined Admin
        User::create([
            "first_name" => "Nathalie",
            "last_name"=>"Ammoun",
            "user_type"=>"1",
            "phone" => "+96176633138",
            "email"=> "nathalie@gmail.com",
            "password"=> bcrypt("password"),
            ]);
        //Predefined Collectors
        User::create([
            "first_name" => "Collector",
            "last_name"=>"Collector",
            "user_type"=>"4",
            "phone" => "+96176633138",
            "email"=> "nathalie.ammoun98@gmail.com",
            "password"=> bcrypt("password"),
            ]);
        Collector::create([
            "name"=>"LiveLoveRecycle",
            "user_id"=>"2",
            "is_approved"=>"0",
            "description"=>"With Live Love Recycle, Recycling is Easy, Fast, and FREE !"
        ]);
        CollectorRecycle::create([
            "collector_id"=>"1",
            "recyclable_id"=>"1"
        ]);
        CollectorRecycle::create([
            "collector_id"=>"1",
            "recyclable_id"=>"2"
        ]);
        CollectorRecycle::create([
            "collector_id"=>"1",
            "recyclable_id"=>"3"
        ]);
        CollectorRecycle::create([
            "collector_id"=>"1",
            "recyclable_id"=>"4"
        ]);
        User::create([
            "first_name" => "Collector2",
            "last_name"=>"Collector",
            "user_type"=>"4",
            "phone" => "+96176633138",
            "email"=> "nathalie.a.ammoun@gmail.com",
            "password"=> bcrypt("password"),
            ]);
            Collector::create([
                "name"=>"Lebanon Waste Management",
                "user_id"=>"3",
                "is_approved"=>"0",
                "description"=>"let's manage the waste and recycle!"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"2",
                "recyclable_id"=>"1"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"2",
                "recyclable_id"=>"2"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"2",
                "recyclable_id"=>"3"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"2",
                "recyclable_id"=>"4"
            ]);
        User::create([
            "first_name" => "Collector3",
            "last_name"=>"Collector",
            "user_type"=>"4",
            "phone" => "+96176633138",
            "email"=> "collector3@gmail.com",
            "password"=> bcrypt("password"),
            ]);
            Collector::create([
                "name"=>"SUKLIN",
                "user_id"=>"4",
                "is_approved"=>"0",
                "description"=>"te7roz tefroz"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"3",
                "recyclable_id"=>"1"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"3",
                "recyclable_id"=>"2"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"3",
                "recyclable_id"=>"3"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"3",
                "recyclable_id"=>"4"
            ]);

        User::create([
            "first_name" => "Collector4",
            "last_name"=>"Collector",
            "user_type"=>"4",
            "phone" => "+96176633138",
            "email"=> "collector4@gmail.com",
            "password"=> bcrypt("password"),
            ]);
            Collector::create([
                "name"=>"Yalla Recycle",
                "user_id"=>"5",
                "is_approved"=>"0",
                "description"=>"Yalla Recycle is easy now with Garbon Recycling"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"4",
                "recyclable_id"=>"1"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"4",
                "recyclable_id"=>"2"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"4",
                "recyclable_id"=>"3"
            ]);
            CollectorRecycle::create([
                "collector_id"=>"4",
                "recyclable_id"=>"4"
            ]);
    }
}
