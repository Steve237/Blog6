<?php

namespace App\Form;

use App\Entity\Figures;
use App\Form\VideoType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AddFigureType extends AbstractType
{   

    /**
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    public function getConfiguration($label, $placeholder) {

        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomFigure', TextType::class, $this->getConfiguration('Nom de la figure', 'Entrez le nom de la figure'))
            ->add('description', TextareaType::class)
            ->add('groupe')
            ->add('imageFile', FileType::class, $this->getConfiguration('Image à la une', ""), ['required' => false]) 
            ->add(
                'images', 
                CollectionType::class, 
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'required' => false
                ]
            )
            ->add(
                'videos', 
                CollectionType::class, 
                [
                    'entry_type' => VideoType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figures::class,
        ]);
    }
}
