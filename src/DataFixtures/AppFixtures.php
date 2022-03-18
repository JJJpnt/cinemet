<?php

namespace App\DataFixtures;

use App\Entity\Film;
use App\Entity\Genre;
use App\Repository\GenreRepository;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $factory = new Factory();
        $faker = $factory->create('fr_FR');

        $genres = [
            'Horreur',
            'Action',
            'Horreur',
            'Dessin animé',
            'Romance',
            'Drame',
            'SF',
            'Thriller',            
        ];

        foreach($genres as $gName) {
            $genre = new Genre();
            $genre->setName($gName);
            $manager->persist($genre);
        }

        $manager->flush();

        for($i=0 ; $i<30 ; $i++)
        {
            $film = new Film();
            $film->setName($faker->company)
                 ->setSynopsis($faker->catchphrase)
                 ->setMedia("https://picsum.photos/1024/768")
                 ;

            $genres = $manager->getRepository(Genre::class)->findAll();

            foreach($faker->randomElements($genres, random_int(1, 3)) as $g) 
                $film->addGenre($g);

            $manager->persist($film);
        }
        $manager->flush();
    }
}
