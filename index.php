<?php

use HttpClient\Request;
use HttpClient\Variables;
use HttpClient\Exceptions\FailureResponse;

require_once __DIR__ . '/vendor/autoload.php';

echo '<div style="height: 25%;border: 2px dotted red; overflow: scroll;margin-bottom: 20px">';
try {
    $response = (new Request())
        ->execute(
            Variables::METHOD_GET,
            'https://api.tvmaze.com/singlesearch/shows',
            [
                'params' => [
                    'q' => 'girls',
                    'embed' => 'episodes',
                ]
            ]
        );

    echo $response->getBody();
} catch (FailureResponse $e) {
    echo 'Failed to connect: ' . $e->getMessage();
}

echo '</div><div style="height: 25%;border: 2px dotted red; overflow: scroll;margin-bottom: 20px">';

try {
    $response = (new \HttpClient\Builder(Variables::METHOD_GET, 'https://api.tvmaze.com/lookup/shows'))
        ->setQuery(['imdb' => 'tt0944947'])
        ->execute();

    echo $response->getBody();
} catch (FailureResponse $e) {
    echo 'Failed to connect: ' . $e->getMessage();
}
echo '</div><div style="height: 25%;border: 2px dotted red; overflow: scroll;margin-bottom: 20px">';

try {
    $request = (new \Nyholm\Psr7\Uri())
        ->withHost('api.tvmaze.com/schedule/web')
        ->withScheme(Variables::SCHEME_HTTPS)
        ->withQuery('date=2020-05-29&country=US');

    $response = (new \HttpClient\Builder(Variables::METHOD_GET, $request))->execute();

    echo $response->getBody();
} catch (FailureResponse $e) {
    echo 'Failed to connect: ' . $e->getMessage();
}
echo '</div>';