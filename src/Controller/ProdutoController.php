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

    /**
     * 
     * @Route("produto/editar/{id}", name="editar_produto")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository(Produto::class)->find($id);

        $form = $this->createForm(ProdutoType::class, $produto);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($produto);
            $em->flush();

            $this->get('session')
                 ->getFlashBag()
                 ->set('success', $produto->getNome() . ' foi atualizado com sucesso');

            return $this->redirectToRoute('listar_produto');

        }

        return $this->render("produto/update.html.twig", 
        [
            'form' => $form->createView(),
            'produto' => $produto
        ]);
    }

    /**
     * 
     * @Route("produto/visualizar/{id}", name="visualizar_produto")
     */
    public function view(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository(Produto::class)->find($id);

        return $this->render('produto/view.html.twig', 
        [
            'produto' => $produto
        ]);
    }

    /**
     * 
     * @Route("produto/apagar/{id}", name="apagar_produto")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $produto = $em->getRepository(Produto::class)->find($id);

        if(!$produto){

            $message = "O produto não foi encontrado";
            $type = "warning";
        
        }else{

            $em->remove($produto);
            $em->flush();

            $message = "Produto excluído com sucesso";
            $type = "success";
        }

        $this->get('session')->getFlashBag()->set($type, $message);

        return $this->redirectToRoute('listar_produto');
    }
}
