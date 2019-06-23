<?php

namespace App\Controller;

use App\Entity\Produto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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

    
    /**
     * @return Response
     * 
     * @Route("cadastrar-produto")
     */
    public function produto(){

        $em = $this->getDoctrine()->getManager();

        $produto = new Produto();
        $produto->setNome('Celular')
                ->setPreco(1000.00);
        
        $em->persist($produto);
        $em->flush();

        return new Response("O produto {$produto->getId()} foi cafastrado com sucesso");
    }
}