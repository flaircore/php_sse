<?php

namespace Nick\PhpSse;

use \Faker\Factory;
use Nick\PhpSse\Entity\Message;
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

    public function generateFakeMessages(){
        // create demos
        for ($i = 0; $i < 220; ++$i) {
            do {
                $from = rand(1, 30);
                $to = rand(1, 30);
            } while ($from === $to);
            $toUser = $this->entityManager->find(User::class, $to);
            $fromUser = $this->entityManager->find(User::class, $from);
            $message = new Message();
            $message->setFrom($fromUser);
            $message->setTo($toUser);
            $message->setMessage($this->faker->sentence());
            $this->entityManager->persist($message);
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

}