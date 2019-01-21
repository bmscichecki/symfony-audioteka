<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AuthorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author_name', TextType::class, array(
                'label' => 'Nazwa autora',
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}