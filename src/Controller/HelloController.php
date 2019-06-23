<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HelloController extends Controller
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

    /**
     * 
     * @Route("mensagem")
     */
    public function mensagem(){
        
        return $this->render('mensagem/hello.html.twig', [
            'mensagem' => 'Olá mundo!!! (teste)'
        ]);
    }
}