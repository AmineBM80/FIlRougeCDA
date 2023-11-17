<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;

class UsersFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = New Users();
        $admin->setEmail('admin@demo.fr');
        $admin->setLastname('BEN MANSOUR');
        $admin->setFirstname('Amine');
        $admin->setAdress('30 rue de Poulainville');
        $admin->setZipcode('80000');
        $admin->setCity('Amiens');
        $admin->setPhone('0636656565');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin1')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for($usr =1; $usr <= 5; $usr++){
            $user = New Users();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setAdress($faker->streetAddress);
            $user->setZipcode(str_replace(' ', '',$faker->postcode));
            $user->setCity($faker->city);
            $user->setPhone(str_replace(' ', '',$faker->phoneNumber));
            $user->setPassword(
                $this->passwordEncoder->hashPassword($user, 'secret')
            );
            $manager->persist($user);
        }
        $manager->flush();
    }
}
