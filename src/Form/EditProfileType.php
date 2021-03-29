<?php

namespace App\Form;

use App\Entity\Users;
use App\Form\AdressesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('userType', ChoiceType::class, ['attr' => ['class' => 'center'], 'label' => 'Etes-vous un ',
        'choices' => [
            'Particulier' => 'Particulier',
            'Professionnel' => 'Professionnel',

        ],
    ])
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
        //    ->add('adresses', CollectionType::class, ['entry_type'=> AdressesType::class])
            ->add('Valider', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
