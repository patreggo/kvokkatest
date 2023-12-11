<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Profile;
use App\Entity\Colors;
use App\Entity\Figures;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

    
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Kvokka Test');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Profile', 'fas fa-question-circle', Profile::class);
        yield MenuItem::linkToCrud('Colors', 'fas fa-question-circle', Colors::class);
        yield MenuItem::linkToCrud('Figures', 'fas fa-question-circle', Figures::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
