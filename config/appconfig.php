<?php return array (
  'parameters' => 
  array (
  ),
  'services' => 
  array (
    'app' => 
    array (
      'class' => 'Framework\\Kernel',
      'arguments' => 
      array (
        0 => '@service_container',
        1 => '@request',
      ),
    ),
    'request' => 
    array (
      'factoryStaticMethod' => 
      array (
        0 => 'Symfony\\Component\\HttpFoundation\\Request',
        1 => 'createFromGlobals',
      ),
    ),
    'controller.default' => 
    array (
      'class' => 'App\\Controller\\DefaultController',
    ),
    'controller.foo' => 
    array (
      'class' => 'App\\Controller\\FooController',
    ),
  ),
  'aliases' => 
  array (
  ),
  'tags' => 
  array (
  ),
);