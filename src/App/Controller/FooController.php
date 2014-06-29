<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FooController
{
    public function barAction(Request $request)
    {
        $name = $request->get('name', 'World');

        return new Response("<h1>Foo controller</h1><p>Hello, $name</p><a href='/'>home</a>");
    }
}
