<?php

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$sample = [
			'age' => 1,
			'rooms' => 3,
			'foundation' => 110,
	        'price' => 125000,
	        'latitude' => 55.6669028,
			'longitude' => 12.5333439,
			'address' => 'Vesterbro/Kongens Enghave Copenhagen Denmark',
			'status' => Property::STATUS_AVAILABLE,
			'user_id' => 1,
    	];
        $properties = [];
        for($i = -10; $i < 10; $i++)
        {
        	$sample['age'] = rand(1,10);
        	$sample['rooms'] = rand(1,4);
        	$sample['foundation'] = rand(60,190);
        	$sample['price'] = rand(140000,530000);
        	$sample['latitude'] = rand(55636902,55696902) / 1000000;
        	$sample['longitude'] = rand(12503343,12563343) / 1000000;
	        $properties[] = $sample;
        }

        foreach($properties as $propery)
        {
        	Property::firstOrCreate($propery);
        }
    }
}
