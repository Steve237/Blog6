<?php

namespace App\Form;

use App\Entity\Figures;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class FiguresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //on ajoute le champs image dans le formulaire
            //Il n'est pas lié à la BDD (mapped=false)
            ->add('image', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figures::class,
        ]);
    }
}
