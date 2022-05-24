<?php

namespace Nick\PhpSse;

use \Faker\Factory;
use \Nick\PhpSse\Entity\User;
class BlogFactory
{
    /**
     * @var Factory;
     */
    private $faker;
    private $entityManager;

    function __construct()
    {
        // use the factory to create a Faker\Generator instance
        $this->faker = Factory::create();
        $dbConn = new DbConn();
        $this->entityManager = $dbConn->entityManager;

    }

    public function generateUsers(){
        $user = [
           "username" => $this->faker->name(),
            "email" => $this->faker->email()
        ];

        return $user;
    }

    public function initGenerate() {
        for ($i = 1; $i <= 30; $i++) {
            $user = new User();
            $username = $this->generateUsers()['username'];
            $email = $this->generateUsers()['email'];
            $user->setUserName($username);
            $user->setEmail($email);
            $this->entityManager->persist($user);
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

}