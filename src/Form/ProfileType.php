<?php

namespace App\Form;

use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image as ConstraintsImage;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextType::class)
            ->add('email')
            ->add('color', EntityType::class,[ 
                'class'=>'App\Entity\Colors',
                'choice_label'=>'color',
             ])
            ->add('figure', EntityType::class,[
                'class'=>'App\Entity\Figures',
                'choice_label'=>'figure',
            ])
            ->add('images', FileType::class,[
                'multiple'=> true,
                'mapped'=> false,
                'constraints'=>
                new All(['constraints'=>[
                    new ConstraintsImage()
                ]])


            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }

    
}
