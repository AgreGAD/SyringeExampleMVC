<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    public function indexAction(Request $request)
    {
        $name = $request->get('name', 'World');

        return new Response("<p>Hello, $name</p><a href='/foo/bar'>Foo:bar action</a>");
    }
}
