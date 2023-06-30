<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Slider;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class SliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slider::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('photo')->setBasePath('images/sliders')->setUploadDir('public/images/sliders')->setUploadedFileNamePattern('[slug]-[timestamp],[extension]'),
            IntegerField::new('ordre'),
            DateTimeField::new('dateEnregistrement')->setFormat('d/M/Y à H:M')->hideOnForm(),

        ];
    }


public function createEntity(string $entityFqcn){
$membre = new $entityFqcn;
$membre->setDateEnregistrement(new DateTime);
return $membre;

}

}