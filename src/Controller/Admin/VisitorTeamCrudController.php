<?php

namespace App\Controller\Admin;

use App\Entity\VisitorTeam;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VisitorTeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VisitorTeam::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('club')
                ->setLabel('Club')
                ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('age_category')
                ->setLabel('Catégorie d\'âge')
                ->setFormTypeOption('choice_label', 'name')
        ];
    }
    
}
