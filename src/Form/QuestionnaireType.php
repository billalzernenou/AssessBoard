<?php

namespace App\Form;

use App\Entity\Front\questionnaire;
use App\Entity\Front\composantes;
use App\Repository\Front\composantesRepository; 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('composant', EntityType::class, [
                'class' => composantes::class,
                'placeholder' => 'Sélectionner une formation',
                'query_builder' => function (composantesRepository $c) {
                    return $c->composantesByName('c');
                }
            ])
            ->add('promo', TextType::class, [
                'attr' => [
                    'placeholder' => 'Promotion'
                ]
            ])
            ->add('year', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Année',
                    'min' => '1900',
                    'max' => '3000'
                ]
            ])
            ->add('ues', CollectionType::class, [
                'entry_type'   => UEType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'label' => false
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Description'
                ]
            ])
            ->add('create', SubmitType::class, [
                'label' => 'Créer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => questionnaire::class,
        ]);
    }
}
