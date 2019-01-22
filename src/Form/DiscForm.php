<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Genre;
use App\Entity\Disc;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options, Genre $genre = null, Author $author = null)
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Tytuł',
                'attr' => array('class' => 'form-control')
            ))
            ->add('genreid', EntityType::class, array(
                'label' => 'Gatunek',
                'data' => $genre,
                'class' => Genre::class,
                'placeholder' => 'Wybierz gatunek',
                'attr' => array('class' => 'form-control')
            ))
            ->add('authorid', EntityType::class, array(
                'label' => 'Autor',
                'data' => $author,
                'class' => Author::class,
                'placeholder' => 'Wybierz autora',
                'attr' => array('class' => 'form-control')
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));

    }

}