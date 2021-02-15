<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,[
                'label'=>'Titre'
            ])
            ->add('description', TextareaType::class,[
                'label'=>'Description'
            ])
            ->add('ville')
            ->add('telephone')
            ->add('email')
            ->add('url', UrlType::class)

            ->add('status_card', ChoiceType::class,[
                'label'=>'Satut',
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