<?php

namespace App\Form;

use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => "Le nom du matériel"
                     ]
            ])
            ->add('category',ChoiceType::class, [
                'choices' => [
                        'Téléphone' => '1',
                        'Ordinateur' => '2',
                        'Usb' => '3',
             ]])
            ->add('number',TextType::class, [
                'attr' => [
                    'placeholder' => "exp: iPhone X 128Gb"
                     ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'placeholder' => "Décrire le matériel en quelques lignes"
                  ]])
               ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipment::class,
        ]);
    }
}
