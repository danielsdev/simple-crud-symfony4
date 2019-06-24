<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProdutoController extends AbstractController
{
    /**
     * @Route("/produto", name="listar_produto")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository(Produto::class)->findAll();

        return $this->render('produto/index.html.twig', [
            'produtos' => $produtos,
        ]);
    }

    /**
     * 
     * @Route("produto/cadastrar", name="cadastrar_produto")
     */
    public function create(Request $request)
    {
        $produto = new Produto();

        $form = $this->createForm(ProdutoType::class, $produto);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $em->persist($produto);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Produto cadastrado com sucesso!');

            return $this->redirectToRoute('listar_produto');
        }

        return $this->render('produto/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
