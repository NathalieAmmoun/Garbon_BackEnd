<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserType;
use App\Models\Industry;
use App\Models\Recyclable;

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
       
    }
}
