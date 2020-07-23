<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dateOfBirth', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('nationality')
            ->add('current_team')
            ->add('bestFoot', ChoiceType::class, [
                'choices' => [
                    'droitier' => 'droitier',
                    'gaucher' => 'gaucher',
                ]
            ])
            ->add('size')
            ->add('weight')
            ->add('price')
            ->add('position', ChoiceType::class, [
                'choices' => [
                    'Attaquant' => 'attaquant',
                    'Milieu' => 'milieu',
                    'Defenseur' => 'defenseur',
                    'Gardien de but' => 'gardien',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
