<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use App\Entity\Patient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create();
        
        for($c=0; $c<30; $c++){
            $doctor = new Doctor();
            $doctor->setFirstname($faker->firstName)
                   ->setLastname($faker->lastName)
                   ->setGrade('Medecin')
                   ->setMatricule('num'+$c);
            
                    $manager->persist($doctor);

            $patient = new Patient();
            $patient->setFirstname($faker->firstName)
                    ->setLastname($faker->lastName)
                    ->setGender('M')
                    ->setAddress($faker->address);
            
                    $manager->persist($patient);
        }



        $manager->flush();
    }
}
