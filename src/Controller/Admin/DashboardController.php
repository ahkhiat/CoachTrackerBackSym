<?php

namespace App\Controller\Admin;

use App\Entity\Club;
use App\Entity\Team;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Season;
use App\Entity\Stadium;
use App\Entity\EventType;
use App\Entity\AgeCategory;
use App\Entity\VisitorTeam;
use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/dashboard.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Coach Tracker Back Sym');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', entityFqcn: User::class);
        yield MenuItem::linkToCrud('Evénements', 'fas fa-list', entityFqcn: Event::class);
        yield MenuItem::linkToCrud('Equipes', 'fas fa-users', entityFqcn: Team::class);
        yield MenuItem::linkToCrud('Equipes visiteuses', 'fas fa-users', entityFqcn: VisitorTeam::class);
        yield MenuItem::linkToCrud('Catégories d\'âge', 'fas fa-users', entityFqcn: AgeCategory::class);
        yield MenuItem::linkToCrud('Type d\'événement', 'fas fa-users', entityFqcn: EventType::class);
        yield MenuItem::linkToCrud('Stades', 'fas fa-users', entityFqcn: Stadium::class);
        yield MenuItem::linkToCrud('Saisons', 'fas fa-users', entityFqcn: Season::class);
        yield MenuItem::linkToCrud('Clubs', 'fas fa-users', entityFqcn: Club::class);

    }
}
