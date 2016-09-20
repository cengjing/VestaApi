
<?php
// Routes
$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    //$this->logger->info("Slim-Skeleton '/' route");
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});