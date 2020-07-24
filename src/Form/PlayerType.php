<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom et prénom',
            ])
            ->add('dateOfBirth', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('nationality', TextType::class, [
                'label' => 'Nationalité',
            ])
            ->add('current_team', TextType::class, [
                'label' => 'Club actuel',
            ])
            ->add('bestFoot', ChoiceType::class, [
                'label' => 'Pied fort',
                'choices' => [
                    'Droitier' => 'Droitier',
                    'Gaucher' => 'Gaucher',
                ]
            ])
            ->add('size', IntegerType::class, [
                'label' => 'Taille en cm',
            ])
            ->add('weight', IntegerType::class, [
                'label' => 'Poids en kg',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'Prix en euros'
            ])
            ->add('position', ChoiceType::class, [
                'label' => 'Poste',
                'choices' => [
                    'Attaquant' => 'Attaquant',
                    'Milieu' => 'Milieu',
                    'Defenseur' => 'Defenseur',
                    'Gardien de but' => 'Gardien',
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
