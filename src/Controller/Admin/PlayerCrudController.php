<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', 'Utilisateur')
                ->setQueryBuilder(function (QueryBuilder $qb) {
                    return $qb
                        ->leftJoin('entity.player', 'p')
                        ->leftJoin('entity.coach', 'c')
                        ->where('p.id IS NULL')
                        ->andWhere('c.id IS NULL'); 
                }),
    
            AssociationField::new('plays_in', 'Joue dans l\'équipe'),
        ];
    }
    
}
