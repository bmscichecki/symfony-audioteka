<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'E-mail',
                'mapped' => 'false',
                'constraints' => [
                  new NotBlank([
                      'message' => 'Podaj E-mail',
                  ])
                ],
                'attr' => array('class' => 'form-control')
                )
            )
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Hasło',
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Podaj hasło',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Hasło powinno składać się z minimum {{ limit }} znaków',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => array('class' => 'form-control')
            ])
            ->add('zarejestruj', SubmitType::class, array(
                'label' => 'Zarejestruj!',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
