<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur') 
            ->add('categorie', ChoiceType::class, [
                "choices"=>[
                    "Spa" => "Spa",
                    "Restaurant" => "Restaurant",
                    "Chambre" => "Chambre"
                ]
            ])
            ->add('commentaire')
           
            // ->add('date_enregistrement')
            ->add('note', ChoiceType::class, [
                "choices"=>[
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5"        
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
