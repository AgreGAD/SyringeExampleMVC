<?php

namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Syringe\Component\DI\Container;

class Kernel
{
    const DEFAULT_CONTROLLER = 'default';
    const DEFAULT_ACTION     = 'index';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Container $container
     * @param Request $request
     */
    public function __construct(Container $container, Request $request)
    {
        $this->container = $container;
        $this->request   = $request;
    }

    /**
     * @throws \RuntimeException if controller service is not found
     * @throws \RuntimeException if action method is not exist
     * @throws \RuntimeException if is incorrect controller response
     */
    public function run()
    {
        $controller = $this->getController($this->request->getPathInfo());

        $response = call_user_func_array($controller, [$this->request]);

        if (!$response instanceof Response) {
            throw new \RuntimeException('Is incorrect controller response');
        }

        $response->send();
    }

    /**
     * @param string $path
     * @return array Controller callable
     * @throws \RuntimeException if controller service is not found
     * @throws \RuntimeException if action method is not exist
     */
    protected function getController($path)
    {
        $pathList = explode('/', $path);

        $controllerServiceName = !empty($pathList[1]) ? $pathList[1] : self::DEFAULT_CONTROLLER;
        $actionName            = !empty($pathList[2]) ? $pathList[2] : self::DEFAULT_ACTION;

        $controllerObject = $this->container->get('controller.' . $controllerServiceName);
        $actionMethod     = $actionName . 'Action';

        if (!method_exists($controllerObject, $actionMethod)) {
            throw new \RuntimeException(sprintf(
                'Controller action %s:%s is not exist',
                get_class($controllerObject),
                $actionMethod
            ));
        }

        return [$controllerObject, $actionMethod];
    }
}
