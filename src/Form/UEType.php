<?php

namespace App\Form;

use App\Entity\Front\UE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UEType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'UE'
                ]
            ])
            ->add('hasLessons', CheckboxType::class, [
                'label'    => 'Cours',
                'required' => false
            ])
            ->add('hasTDTP', CheckboxType::class, [
                'label'    => 'TD/TP/Projet',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UE::class,
        ]);
    }
}
