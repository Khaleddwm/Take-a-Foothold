<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchPlayerAdvancedType extends AbstractType
{
    const WEIGHT = [50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100];
    const PRICE = [1000000, 5000000, 1000000, 15000000, 20000000, 50000000, 75000000, 100000000, 250000000];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
            ->add('position', ChoiceType::class, [
                'label' => 'Poste',
                'choices' => [
                    'Attaquant' => 'Attaquant',
                    'Milieu' => 'Milieu',
                    'Defenseur' => 'Defenseur',
                    'Gardien de but' => 'Gardien',
                ]
            ])
            ->add('bestFoot', ChoiceType::class, [
                'label' => 'Pied fort',
                'choices' => [
                    'Droitier' => 'Droitier',
                    'Gaucher' => 'Gaucher',
                ]
            ])
            ->add('minWeight', ChoiceType::class, [
                'label' =>'Poids minimum en kg',
                'choices' => array_combine(self::WEIGHT, self::WEIGHT),
            ])
            ->add('maxWeight', ChoiceType::class, [
                'label' =>'Poids maximum en kg',
                'choices' => array_combine(self::WEIGHT, self::WEIGHT),
            ])
            ->add('minPrice', ChoiceType::class, [
                'label' =>'Prix minimum en euros',
                'choices' => array_combine(self::PRICE, self::PRICE),
            ])
            ->add('maxPrice', ChoiceType::class, [
                'label' =>'Prix maximum en euros',
                'choices' => array_combine(self::PRICE, self::PRICE),
            ])
        ;
    }
}
