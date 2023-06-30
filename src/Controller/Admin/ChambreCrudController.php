<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextField::new('description_courte', 'description courte'),
            TextEditorField::new('description_longue', 'description longue'),
            ImageField::new('photo')->setBasePath('images/chambre')->setUploadDir('public/images/chambre')->setUploadedFileNamePattern('[slug]-[timestamp],[extension]'),
            IntegerField::new('prix_journalier', 'prix à la journée'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y à H:M')->hideOnForm(),
        ];
    }


    public function createEntity(string $entityFqcn){
        $chambre = new $entityFqcn;
        $chambre->setDateEnregistrement(new \DateTime);
        return $chambre;
        
    }
}
