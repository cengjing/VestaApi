
<?php
use Chadicus\Slim\OAuth2\Http\RequestBridge;
use Chadicus\Slim\OAuth2\Http\ResponseBridge;
use Chadicus\Slim\OAuth2\Middleware;
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->post('/token', function ($request, $response, array $args) use ($app, $server) {
    //create an \OAuth2\Request from the current \Slim\Http\Request Object
    $oauth2Request = RequestBridge::toOAuth2($request);

    //Allow the oauth2 server instance to handle the oauth2 request
    $oauth2Response = $server->handleTokenRequest($oauth2Request);

    //Map the oauth2 response into the slim response
    return ResponseBridge::fromOAuth2($oauth2Response);
});


$authMiddleware = new Middleware\Authorization($server, $app->getContainer());

$app->get('/codes', function (Request $request, Response $response, array $args) use ($app, $server) {

    $data = [
        'codes' => [[
            'id' => 1,
            'description' => 'Obama Nuclear Missile Launching Code is: !lovedronesandthensa'
        ],[
            'id' => 2,
            'description' => 'Putin Nuclear Missile Launching Code is: !invasioncoolashuntingshirtless'
        ]]
    ];
    return $response->withJson($data);
})->add($authMiddleware);