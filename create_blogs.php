<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

use Nick\PhpSse\BlogFactory;


$event = new Event(function () {
    $id = mt_rand(1, 1000);
    $news = [['id' => $id, 'title' => 'title ' . $id, 'content' => 'content ' . $id]]; // Get news from database or service.
    if (empty($news)) {
        return false; // Return false if no new messages
    }
    $shouldStop = false; // Stop if something happens or to clear connection, browser will retry
    if ($shouldStop) {
        throw new StopSSEException();
    }
    return json_encode(compact('news'));
    // return ['event' => 'ping', 'data' => 'ping data']; // Custom event temporarily: send ping event
    // return ['id' => uniqid(), 'data' => json_encode(compact('news'))]; // Custom event Id
}, 'news');
(new SSESwoole($event, $request, $response))->start();
