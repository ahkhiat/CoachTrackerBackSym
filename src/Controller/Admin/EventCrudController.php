<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Evénement')
            ->setEntityLabelInPlural('Evénements')
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            DateField::new('date'),
            // TextEditorField::new('description'),
            AssociationField::new('team')
                ->setLabel('Equipe')
                ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('visitor_team')
                ->setLabel('Visiteur')
                // ->setFormTypeOption('choice_label', 'name')
                ,
            AssociationField::new('event_type')
                ->setLabel('Type d\'événement')
                ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('stadium')
                ->setLabel('Lieu')
                ->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('season')
                ->setLabel('Saison')
                ->setFormTypeOption('choice_label', 'name')

        ];
    }
    
}
