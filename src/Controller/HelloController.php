<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{

    public function hello(){

        return new Response(
            "<html><h1>Hello world</h1></html>"
        );
    }
}