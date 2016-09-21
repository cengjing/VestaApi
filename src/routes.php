
<?php
use Chadicus\Slim\OAuth2\Http\RequestBridge;
use Chadicus\Slim\OAuth2\Http\ResponseBridge;

// Routes
/*
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
*/

$app->post('/token', function ($request, $response, array $args) use ($app, $server) {
    //create an \OAuth2\Request from the current \Slim\Http\Request Object
    $oauth2Request = RequestBridge::toOAuth2($request);

    //Allow the oauth2 server instance to handle the oauth2 request
    $oauth2Response = $server->handleTokenRequest($oauth2Request);

    //Map the oauth2 response into the slim response
    return ResponseBridge::fromOAuth2($oauth2Response);
});