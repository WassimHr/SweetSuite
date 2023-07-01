<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('email'),
            TextField::new('prenom', 'prenom'),
            TextField::new('nom', 'nom'),
            TextField::new('pseudo', 'pseudo'),
            TextField::new('mdp', 'mot de passe')->setFormType(PasswordType::class)->onlyWhenCreating(), 
            TextField::new('civilite', 'civilite'),
            TextField::new('statut', 'statut'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y à H:M')->hideOnForm(),

        ];
    }


public function createEntity(string $entityFqcn){
$membre = new $entityFqcn;
$membre->setDateEnregistrement(new \DateTime);
return $membre;

}
    
}
