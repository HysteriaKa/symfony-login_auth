<?php

namespace App\Form;

use App\Entity\Questions;
use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salaire', ChoiceType::class,['label'=>'Revenus du foyer', 'choices'=>[
                'aucun'=>"aucun",
                '0 à 50K€'=>'0 à 50K€',
                '50 à 100K€'=>'0 à 100K€',
                '0 à 50K€'=>'100 à 300K€',
                'plus de 300K€'=>'plus de 300K€',
            ]])
            ->add('question1', ChoiceType::class,[
                'label'=>'Avez-vous déjà réalisé des opérations sur des instruments financiers ?',
                'choices'=>[
                    'oui'=>"oui",
                    'non'=>"non",
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
