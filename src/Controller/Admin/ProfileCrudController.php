<?php

namespace App\Controller\Admin;

use App\Entity\Colors;
use App\Entity\Profile;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profile::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        yield IdField::new('id');
        yield TextField::new('email');
        yield AssociationField::new('color')->setFormType('choice_label', 'color') ->setFormTypeOption('by_reference', false);
        yield AssociationField::new('figure');
        yield CollectionField::new('images');
        
    }
    
}
