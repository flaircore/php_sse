<?php
/**
 * Gets a list of messages between the passed request params,
 * ie from and to[]
 */
require_once dirname(__FILE__) . '/bootstrap.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nick\PhpSse\DbConn;
use Nick\PhpSse\Renderer;

$request = Request::createFromGlobals();

$dbConn = new DbConn();
$renderer = new Renderer();
$entityManager = $dbConn->entityManager;

$from = $request->get('from');
$to = $request->get('to');

// http://localhost:8080/get_messages.php?from=30&to=7

$query = $entityManager->createQueryBuilder()
    ->from(\Nick\PhpSse\Entity\Message::class, 'm')
    ->innerJoin('m.to', 'mu')
    ->andWhere('m.from = :from')
    ->andWhere('mu.id IN (:to)')
    //->select('*')
    ->select('m')
    //->groupBy('m.from')
    ->setParameters(['from' => $from, 'to' => $to])
    ->getQuery();

try {

    $messages = $query->getResult();
    $renderMsgList = $renderer->renderMessageList($messages, $from);

} catch (Throwable $e) {
    throw $e;
}

$response = new Response();
$response->setContent($renderMsgList);

// the headers public attribute is a ResponseHeaderBag
$response->headers->set('Content-Type', 'text/html');

$response->setStatusCode(Response::HTTP_OK);
$response->prepare($request);
$response->send();