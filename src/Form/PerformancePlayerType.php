<?php

namespace App\Form;

use App\Entity\Performance;
use App\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformancePlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saison', IntegerType::class)
            ->add('assist', IntegerType::class, [
                'label' => 'passe(s) décisive(s)',
            ])
            ->add('goal', IntegerType::class, [
                'label' => 'but(s) marqué(s)',
            ])
            ->add('timePlayed', IntegerType::class, [
                'label' => 'Temps de jeu',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performance::class,
        ]);
    }
}
