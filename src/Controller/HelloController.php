<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController
{

    /**
     * @return Response
     * 
     * @Route("hello_world")
     */

    public function hello(){

        return new Response(
            "<html><h1>Hello world</h1></html>"
        );

    }
}