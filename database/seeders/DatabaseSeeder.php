<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;
use App\Models\Industry;
use App\Models\Recyclable;
use App\Models\User;
use App\Models\TimeSlot;
use App\Models\CollectorRecycle;
use App\Models\Collector;
use App\Models\Address;
use App\Models\PickupRequest;
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

            Address::create([
                "city" => "Beirut",
                "street"=>"Hamra Street",
                "bldg"=>"Rasamni Bldg",
                "floor" => "2nd Floor",
                "user_id"=> "1",
                ]);
        //Predefined Collectors
        User::create([
            "first_name" => "Charbel",
            "last_name"=>"Daoud",
            "user_type"=>"4",
            "phone" => "+96176633138",
            "email"=> "nathalie.ammoun98@gmail.com",
            "password"=> bcrypt("password"),
            ]);
        Collector::create([
            "name"=>"LiveLoveRecycle",
            "user_id"=>"2",
            "is_approved"=>"1",
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
                "is_approved"=>"1",
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

            TimeSlot::create([
                
                "time_slot"=>"09:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"10:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"11:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"12:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"13:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"14:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"15:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"16:00"
            ]);
            TimeSlot::create([
                
                "time_slot"=>"17:00"
            ]);
            PickupRequest::create([
                    "user_id"=>"1",
                    "address_id"=>"1",
                    "collector_id"=>"1",
                    "is_approved"=>"0",
                    "is_declined"=>"0",
                    "is_done"=>"0",
                    "is_canceled"=>"0",
                    "pickup_date" =>"2021-11-02",
                    "pickup_time" =>"09:00",
                    "pickup_time_id"=>"1"

            ]);
            PickupRequest::create([
                "user_id"=>"1",
                "address_id"=>"1",
                "collector_id"=>"1",
                "is_approved"=>"1",
                "is_declined"=>"0",
                "is_done"=>"1",
                "is_canceled"=>"0",
                "pickup_date" =>"2021-11-02",
                "pickup_time" =>"11:00",
                "pickup_time_id"=>"3"

        ]);
        PickupRequest::create([
            "user_id"=>"1",
            "address_id"=>"1",
            "collector_id"=>"1",
            "is_approved"=>"1",
            "is_declined"=>"0",
            "is_done"=>"0",
            "is_canceled"=>"0",
            "pickup_date" =>"2021-11-03",
            "pickup_time" =>"11:00",
            "pickup_time_id"=>"3"

    ]);

    PickupRequest::create([
        "user_id"=>"1",
        "address_id"=>"1",
        "collector_id"=>"1",
        "is_approved"=>"0",
        "is_declined"=>"0",
        "is_done"=>"0",
        "is_canceled"=>"0",
        "pickup_date" =>"2021-11-03",
        "pickup_time" =>"14:00",
        "pickup_time_id"=>"6"

]);
PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"1",
    "is_declined"=>"0",
    "is_done"=>"1",
    "is_canceled"=>"0",
    "pickup_date" =>"2021-11-03",
    "pickup_time" =>"12:00",
    "pickup_time_id"=>"4"

]);
PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"1",
    "is_declined"=>"0",
    "is_done"=>"0",
    "is_canceled"=>"0",
    "pickup_date" =>"2021-11-04",
    "pickup_time" =>"12:00",
    "pickup_time_id"=>"4"

]);

PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"0",
    "is_declined"=>"0",
    "is_done"=>"0",
    "is_canceled"=>"1",
    "pickup_date" =>"2021-11-05",
    "pickup_time" =>"12:00",
    "pickup_time_id"=>"4"

]);
PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"1",
    "is_declined"=>"0",
    "is_done"=>"0",
    "is_canceled"=>"0",
    "pickup_date" =>"2021-11-06",
    "pickup_time" =>"12:00",
    "pickup_time_id"=>"4"

]);
PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"0",
    "is_declined"=>"0",
    "is_done"=>"0",
    "is_canceled"=>"0",
    "pickup_date" =>"2021-11-05",
    "pickup_time" =>"09:00",
    "pickup_time_id"=>"1"

]);
PickupRequest::create([
    "user_id"=>"1",
    "address_id"=>"1",
    "collector_id"=>"1",
    "is_approved"=>"0",
    "is_declined"=>"0",
    "is_done"=>"0",
    "is_canceled"=>"0",
    "pickup_date" =>"2021-11-04",
    "pickup_time" =>"10:00",
    "pickup_time_id"=>"2"

]);
    }
}
