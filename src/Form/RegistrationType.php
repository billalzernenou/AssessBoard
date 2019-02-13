<?php

namespace App\Form;

use App\Entity\Back\User;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormError;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('username')
            ->add('roles', ChoiceType::class, [
              'multiple' => true,
              'expanded' => true,
              'choices'  => [
                    'USER'        =>'ROLE_USER',
                    'ADMIN'       =>'ROLE_ADMIN',
                    'SUPER ADMIN' => 'ROLE_SUPER_ADMIN'
                  ]
            ]);
            //->add('password', PasswordType::class)
            //->add('confirm_password', PasswordType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
