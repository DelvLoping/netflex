<?php

namespace App\DataFixtures;

use App\Entity\Categorize;
use App\Entity\Comment;
use App\Entity\Contributor;
use App\Entity\Favorites;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\FilmCrew;
use App\Entity\Job;
use App\Entity\Rate;
use App\Entity\Seen;
use App\Entity\Users;
use App\Repository\CategorizeRepository;
use App\Repository\CommentRepository;
use App\Repository\ContributorRepository;
use App\Repository\FavoritesRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\FilmCrewRepository;
use App\Repository\JobRepository;
use App\Repository\RateRepository;
use App\Repository\SeenRepository;
use App\Repository\UsersRepository;
use Faker\Factory;
use Faker\Provider\en_US\Company;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nb = 4;
        $factory = new Factory();
        $faker = $factory->create('fr_FR');
        $genreList=['Horreur','Action','Aventure','Comedie','Romantique'];

        $Movie = Array();
        for ($i = 0; $i < $nb; $i++) {
            $Movie[$i] = new Movie();
            $Movie[$i]->setTitle($faker->company);
            $Movie[$i]->setResume($faker->realText);
            $Movie[$i]->setDateRelease($faker->dateTime);
            $Movie[$i]->setDuree($faker->randomDigit*11);
            $Movie[$i]->setImg('https://m.media-amazon.com/images/M/MV5BZGM4ZGJiM2UtMmYyYi00Y2YzLTk5ZWEtN2ZkNzBlYTczZjQwXkEyXkFqcGdeQUlNRGJWaWRlb1RodW1ibmFpbFNlcnZpY2U@._V1_.jpg');
            $Movie[$i]->setTrailer('https://www.imdb.com/video/imdb/vi447873305/imdb/embed');

            $manager->persist($Movie[$i]);
        }
        $manager->flush();

        $Genre = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Genre[$i] = new Genre();
           $Genre[$i]->setName($faker->randomElement($genreList));

           $manager->persist($Genre[$i]);
        }
        $manager->flush();


        $Users = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Users[$i] = new Users();
           $Users[$i]->setUsername($faker->userName);
           $Users[$i]->setPassword($faker->password);
           $Users[$i]->setEmail($faker->email); 
           $Users[$i]->setRoles($Users[$i]->getRoles());              
           $manager->persist($Users[$i]);
        }
        $manager->flush();
         
        $Contributor = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Contributor[$i] = new Contributor();
           $Contributor[$i]->setName($faker->name);
                      
           $manager->persist($Contributor[$i]);
        }
        

        $manager->flush();

        $Job = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Job[$i] = new Job();
           $Job[$i]->setName($faker->word);
                
           $manager->persist($Job[$i]);
        }
        
        $manager->flush();

        $movies = $manager->getRepository(Movie::class)->findAll();
        $genres = $manager->getRepository(Genre::class)->findAll();
        $userss = $manager->getRepository(Users::class)->findAll();
        $contributors = $manager->getRepository(Contributor::class)->findAll();
        $jobs = $manager->getRepository(Job::class)->findAll();


        $Categorize = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Categorize[$i] = new Categorize();
    
           $Categorize[$i]->setIdMovie($faker->randomElement($movies));
           $Categorize[$i]->setIdGenre($faker->randomElement($genres));
                
           $manager->persist($Categorize[$i]);
        }
        
        $manager->flush();

        $Comment = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Comment[$i] = new Comment();
           $Comment[$i]->setText($faker->realText);
           $Comment[$i]->setDateComment($faker->dateTime);
           $Comment[$i]->setIdMovie($faker->randomElement($movies));
           $Comment[$i]->setIdUsers($faker->randomElement($userss));
                
           $manager->persist($Comment[$i]);
        }
        
        $manager->flush();

        $Seen = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Seen[$i] = new Seen();
           $Seen[$i]->setIdMovie($faker->randomElement($movies));
           $Seen[$i]->setIdUsers($faker->randomElement($userss));
                
           $manager->persist($Seen[$i]);
        }
        
        $manager->flush();

        $Favorites = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Favorites[$i] = new Favorites();
           $Favorites[$i]->setIdMovie($faker->randomElement($movies));
           $Favorites[$i]->setIdUsers($faker->randomElement($userss));
                
           $manager->persist($Favorites[$i]);
        }
        $manager->flush();

        $Rate = Array();
        for ($i = 0; $i < $nb; $i++) {
           $Rate[$i] = new Rate();
           $Rate[$i]->setRate($faker->numberBetween(1,5));
           $Rate[$i]->setIdMovie($faker->randomElement($movies));
           $Rate[$i]->setIdUsers($faker->randomElement($userss));
                
           $manager->persist($Rate[$i]);
        }
        
        $manager->flush();

        $FilmCrew = Array();
        for ($i = 0; $i < $nb; $i++) {
           $FilmCrew[$i] = new FilmCrew();
           $FilmCrew[$i]->setIdMovie($faker->randomElement($movies));
           $FilmCrew[$i]->setIdContributor($faker->randomElement($contributors));
           $FilmCrew[$i]->setIdJob($faker->randomElement($jobs));

                
           $manager->persist($FilmCrew[$i]);
        }
        
        $manager->flush();
        
    }
}
