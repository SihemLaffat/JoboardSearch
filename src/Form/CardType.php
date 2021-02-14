<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('url', UrlType::class)

            ->add('status_card', ChoiceType::class,[
                'choices'  => [
                    'Va postuler' => 'va postuler',
                    'A postulé' => 'postuler',
                    'A relancé' => 'relancer',
                    'A rencontré' => 'rencontre',
                    
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