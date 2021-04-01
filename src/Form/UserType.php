<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', TextType::class, ['attr' => ['maxlength' => 12]])
            ->add('cognome', TextType::class, ['attr' => ['maxlength' => 12]])
            ->add('email', EmailType::class, ['attr' => ['maxlength' => 40]])
            ->add('username', TextType::class, ['attr' => ['maxlength' => 10]])
            ->add('password', PasswordType::class, ['attr' => ['maxlength' => 10]])
            ->add('telefono', NumberType::class, ['attr' => ['maxlength' => 10]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
