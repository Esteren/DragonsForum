<?php

require __DIR__.'/config.php';

$token = isset($_GET['token']) ? $_GET['token'] : null;

if (!defined('SLACK_TOKEN') || $token !== SLACK_TOKEN) {
    http_response_code(400);
    return '';
}

$text = isset($_GET['text']) ? $_GET['text'] : null;

if (!$text) {
    header('X-DiceError: No text provided');
    http_response_code(400);
    return ''
}

preg_match('~^(?<amount>\d+)?d(?<size>\d+)(?<offset>[+-]\d+)??~iu', $text, $matches);

if (!isset($matches['size'])) {
    header('X-DiceError: No size matching');
    http_response_code(400);
    return '';
}

$amount = (int) (isset($matches['amount']) ? $matches['amount'] : 1) ?: 1;
$size = (int) $matches['size'];
$offset = (int) (isset($matches['offset']) ? $matches['offset'] : 0);

$result = rand(1, $size) * $amount + $offset;

$response = [
    'attachments' => [],
];

$response['text'] =  
    '> `Dragon roll!` *'.$_GET['user_name'].'*'.
    ' is throwing for *'.$amount.'d'.$size.($offset ? (($offset > 0 ? '+' : '-') . abs($offset)) : '').'*'.
    ' and gets result : '.
    '`'.$result.'`'
;

if ($result === ($amount + $offset)) {
    $response['attachments'][] = ['text' => 'FAILURE! :boom:', 'mrkdwn' => true];
}
if ($result === ($size * $amount + $offset)) {
    $response['attachments'][] = ['text' => 'CRITICAL! :tada:', 'mrkdwn' => true];
}

if (strpos($text, '-gm') === false) {
    $response['response_type'] = 'in_channel';
}

header('Content-Type: application/json');

echo json_encode($response, 480);

