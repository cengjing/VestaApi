<?php
namespace App\Controller;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * Abstract controller class
 */
abstract class Base
{
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $container;
    /**
     * Controller Contructor.
     *
     * @param \Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * Render a view.
     *
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    protected function render(ResponseInterface $response)
    {
        return $response;
    }
}