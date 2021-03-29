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
            ->add('type', ChoiceType::class,['choices'=>[
                'personnelle'=>1,
                'Professionnelle'=>2,
             'Facturation'=>3,]])

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

    public function __toString()
    {
        return $this->numero;
    }
}
