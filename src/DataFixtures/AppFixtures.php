<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Phone;
use App\Entity\Client;
use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $faker;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create('fr-FR');
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = $this->faker;
        
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
 
        for ($i = 0; $i < 10; $i++) {
            $encoder = $this->encoder;
            $client = new Client();
            $client->setUsername($faker->userName)
                   ->setPassword($encoder->encodePassword($client, 'password'))
                   ->setFirstname($faker->firstName)
                   ->setLastname($faker->lastName)
                   ->setCompany($faker->company)
                   ->setEmail($faker->email)
                   ->setRegisteredAt($faker->dateTimeThisYear())
                   ;

            for ($j = 0; $j < 10; $j++) {
                $customer = new Customer;
                $customer->setFirstname($faker->firstName)
                         ->setLastname($faker->lastName)
                         ->setEmail($faker->email)
                         ->setPassword($faker->password())
                         ->setRegisteredAt($faker->dateTimeThisMonth())
                         ->setClient($client)
                         ;
                         
                $manager->persist($customer);
            }

            $manager->persist($client);
        }

        //  Add an unique client with his fake customers
        $client = new Client();
        $client->setUsername("alex")
               ->setPassword($encoder->encodePassword($client, 'password'))
               ->setFirstname("Alex")
               ->setLastname("Manteaux")
               ->setCompany("AlexDev")
               ->setEmail("alexdev06@gmail.com")
               ->setRegisteredAt($faker->dateTimeThisYear())
                   ;
        for ($k = 0; $k < 10; $k++) {
            $customer = new Customer;
            $customer->setFirstname($faker->firstName)
                     ->setLastname($faker->lastName)
                     ->setEmail($faker->email)
                     ->setPassword($faker->password())
                     ->setRegisteredAt($faker->dateTimeThisMonth())
                     ->setClient($client)
                     ;
                    
            $manager->persist($customer);
        }

        $manager->persist($client);

        $manager->flush();
    }
}
