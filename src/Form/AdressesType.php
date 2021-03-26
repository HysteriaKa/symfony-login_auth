<?php

namespace App\Form;

use App\Entity\Adresses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdressesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class,['attr'=>['class'=>'center'], 'label'=>'Est-ce votre adresse','choices'=>['personnelle'=>'Personnelle','Professionnelle'=>'Professionnelle',
             'Facturation'=>'Facturation']])
            ->add('numero', TextType::class)
            ->add('typevoie', TextType::class)
            ->add('libellevoie', TextType::class)
            ->add('complementAdresse', TextType::class)
            ->add('postalCode', TextType::class)
            ->add('ville', TextType::class)
            ->add('country', TextType::class)
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresses::class,
        ]);
    }
}
