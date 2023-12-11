<?php

namespace App\DataFixtures;

use App\Entity\Colors;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ColorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $color = new Colors();
        $color->setColor('Красный');
        $manager->persist($color);
 
        $color = new Colors();
        $color->setColor('Синий');
        $manager->persist($color);
 
        $color = new Colors();
        $color->setColor('Зеленый');
        $manager->persist($color);
 
        $color = new Colors();
        $color->setColor('Белый');
        $manager->persist($color);

        $manager->flush();
    }
}
