<?php
require_once dirname(__FILE__) . '/bootstrap.php';
use Hhxsv5\SSE\Event;
use Hhxsv5\SSE\SSE;
use Hhxsv5\SSE\StopSSEException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

// PHP-FPM SSE Example: push messages to client
$request = Request::createFromGlobals();
$content = $request->getContent();
//error_log($content);
//die();
$response = new StreamedResponse();
$response->headers->set('Content-Type', 'text/event-stream');
$response->headers->set('Cache-Control', 'no-cache');
$response->headers->set('Connection', 'keep-alive');
$response->headers->set('X-Accel-Buffering', 'no'); // Nginx: unbuffered responses suitable for Comet and HTTP streaming applications'
$response->setCallback(function () use ($content) {
    $callback = function () use ($content) {

        $id = mt_rand(1, 1000);
        $news = [['id' => $id, 'title' => 'title ' . $id, 'content' => $content . $id]]; // Get news from database or service.

        if (isset($content)) {
            return false; // Return false if no new messages
        }
        $shouldStop = false; // Stop if something happens or to clear connection, browser will retry
        if ($shouldStop) {
            throw new StopSSEException();
        }

//        error_log($content);
//        error_log($news);
        return json_encode(compact('news'));
        // return ['event' => 'ping', 'data' => 'ping data']; // Custom event temporarily: send ping event
        // return ['id' => uniqid(), 'data' => json_encode(compact('news'))]; // Custom event Id
    };

    // error_log($content);
    (new SSE(new Event($callback, 'news')))->start();
});

$response->prepare($request);
// $response->setContent("HERER TODAY!!!!!!!!!!!!!!!!!!!!!!");
$response->send();
