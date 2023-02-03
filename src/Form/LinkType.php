<?php

namespace App\Form;

use App\Entity\LinksMap;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [    // Название не важно, может быть пустым
                'required' => true,
                'constraints' => [  
                    new Length([
                        "max" => 50
                    ]),
                ]
            ])
            ->add('originalLink', TextType::class, [  // Короче а.б не поддерживаем
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        "min" => 3,
                        "max" => 1000
                    ]),
                ]
            ])
                /*
            ->add('submit', SubmitType::class, [    // Болванка для кнопки
                
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
