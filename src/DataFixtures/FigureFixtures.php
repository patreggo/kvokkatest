<?php

namespace App\DataFixtures;

use App\Entity\Figures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FigureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $figure = new Figures();
       $figure->setFigure('Треугольник');
       $manager->persist($figure);

       $figure = new Figures();
       $figure->setFigure('Круг');
       $manager->persist($figure);

       $figure = new Figures();
       $figure->setFigure('Квадрат');
       $manager->persist($figure);

       $manager->flush();
       
    }
}