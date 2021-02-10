<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('status_card', ChoiceType::class,[
                'choices'  => [
                    'S1' => 'status 1',
                    'S2' => 'status 2',
                    'S3' => 'status 3',
                    'S4' => 'status 4',
                    
                ],
                'data' => $options['defaultStatus'],
                'expanded'=> false,
                'multiple' => false
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
            'defaultStatus' => 'STATUS'
        ]);
    }
}