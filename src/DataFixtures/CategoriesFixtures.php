<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $parent = $this->createCategory('Manga', null, 'manga.png', $manager);

        $this->createCategory('One piece', $parent, 'one piece.png', $manager);
        $this->createCategory('Naruto', $parent, 'naruto.png', $manager);
        $this->createCategory('Shingeki no Kyojin', $parent, 'snk.png', $manager);
        $this->createCategory('Magi', $parent, 'magi.png', $manager);
        $this->createCategory('Dragon ball', $parent, 'dragonball.png', $manager);

        $parent = $this->createCategory('Disney', null, 'disney.png', $manager);
        $this->createCategory('Reine de Neige', $parent, 'reine_des_neige.png', $manager);
        $this->createCategory('Aladdin', $parent, 'aladdin.png', $manager);

        $parent = $this->createCategory('Marvel', $parent, 'marvel.png', $manager);
        $this->createCategory('IronMan', $parent, 'iron_man.png', $manager);
        $this->createCategory('Capitain America', $parent, 'capitain_america.png', $manager);
        $this->createCategory('SpiderMan', $parent, 'spiderman.png', $manager);


        $manager->flush();
    }

    public function createCategory(string $name, Categories $parent =null, string $image, ObjectManager $manager)
    {
        $category = new Categories();
        $category->setName($name);
        $category->setImage('Img.png');
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $category->setParent($parent);
        $manager->persist($category);

        $this->addReference('cat-'.$this->counter, $category);
        $this->counter++;

        return $category;
    }

}
