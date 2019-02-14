<?php

namespace App\Form;

use App\Entity\Front\answers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mark',ChoiceType::class, [
                'label' => false,
                'choices' => ['0' => '0', '1' => '1', '2' => '2', '3' => '3'],
                'multiple'=>false,
                'expanded'=>true
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => answers::class,
        ]);
    }
}
