<?php

namespace App\Form;

use App\Entity\Produto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProdutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nome', TextType::class, [
            'label' => 'Nome do produto',
            'attr'  => [
                'class' => 'form-control'
            ]
        ])
        ->add('preco', TextType::class, [
            'label' => 'Preço',
            'attr'  => [
                'class' => 'form-control'
            ]
        ])
        ->add('descricao', TextareaType::class, [
            'label' => 'Descrição',
            'attr'  => [
                'class' => 'form-control'
            ]
        ])
        ->add('enviar', SubmitType::class, [
            'label' => 'Salvar',
            'attr'  => [
                'class' => 'btn btn-primary'
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produto::class,
        ]);
    }
}
