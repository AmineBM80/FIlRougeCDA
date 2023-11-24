<?php

namespace App\DataFixtures;

use App\Entity\Images;
use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ImagesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $faker = Faker\Factory::create('fr_FR');

        // for($img = 1; $img <= 10; $img++){
        //     $image = new Images();
        //     $image->setName($faker->image(null, 640, 480));
        //     $product = $this->getReference('prod-'.rand(1,10));
        //     $image->setProduct($product);
        //     $manager->persist($image);
        // }

        $this->createImage('kunai1.jpg', 8 , $manager);
        $this->createImage('kunai2.jpeg', 8 , $manager);
        $this->createImage('kunai3.jpeg', 8 , $manager);

        
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return[
            ProductsFixtures::class
        ];
    }

    public function createImage(string $name, $id_product, ObjectManager $manager)
    {
        $product = $manager->getRepository(Products::class)->find($id_product);

        $image = new Images();
        $image->setName($name);
        $image->setProduct($product);

        $manager->persist($image);
        return $image;
    }
}
