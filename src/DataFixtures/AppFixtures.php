<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');
        
        $listPhones = [
            
            [
                'model' => 'Samsung A5',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 350,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 6S',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 900,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 6S',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1000,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 6S',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1100,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 7S',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 990,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 7S',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1090,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone X',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1090,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone X',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1190,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 8',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 800,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 8',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 900,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone XR',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1090,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone XS',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1290,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone XS',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1190,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Apple Iphone 6S',
                'memory' => '64GB',
                'color' => 'White',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 900,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 6',
                'memory' => '64GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 599,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 6',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 699,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 6T',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 599,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 6T',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 699,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 7',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 599,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 7',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 599,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 7T',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 599,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 7T',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 699,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 8',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 799,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 8',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 899,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 8 Pro',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 899,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'OnePlus 8 Pro',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 999,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10',
                'memory' => '128GB',
                'color' => 'White',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 999,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10',
                'memory' => '128GB',
                'color' => 'White',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 999,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 999,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1099,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10 Plus',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 199,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10 Plus',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1299,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10 Plus',
                'memory' => '256GB',
                'color' => 'White',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1299,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S10 Plus',
                'memory' => '256GB',
                'color' => 'Green',
                'network' => '3G, 4G',
                'description' => $faker->text(400),
                'price' => 1299,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S20',
                'memory' => '256GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 1199,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S20',
                'memory' => '256GB',
                'color' => 'White',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 1199,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S20',
                'memory' => '128GB',
                'color' => 'Black',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 1099,
                'internalReference' => $faker->ean13
            ],
            [
                'model' => 'Samsung Galaxy S20',
                'memory' => '128GB',
                'color' => 'White',
                'network' => '3G, 4G, 5G',
                'description' => $faker->text(400),
                'price' => 1099,
                'internalReference' => $faker->ean13
            ],
        ];

        foreach($listPhones as $uniquePhone) {
            $phone = new Phone();
            foreach($uniquePhone as $property => $value) {
                $method = 'set' . ucfirst($property);
                $phone->$method($value);

                $manager->persist($phone);
            }
        }
 
        $manager->flush();
    }
}
