<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    /**
     * @param UserPasswordHasherInterface $hasher
     */
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $player = new Player();
        $hashedPassword = $this->hasher->hashPassword($player, 'allan');
        $player
            ->setUsername('allan.jarry')
            ->setEmail('allan@drosalys.fr')
            ->setPassword($hashedPassword)
        ;

        $manager->persist($player);
        $manager->flush();
    }
}
