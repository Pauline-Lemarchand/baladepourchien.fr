<?php

namespace App\Controller;

use App\Entity\Balades;
use App\Repository\BaladesRepository;
use App\Repository\GroupesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route(' ', name: 'home')]
    public function index(BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }
    #[Route('/nosconseils', name: 'conseils')]
    public function conseils (BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.conseils.html.twig', [
            'balades' => $baladesRepository->findAll(),
           
        ]);
    }
    #[Route('/nosgroupes', name: 'groupes')]
    public function groupes (BaladesRepository $baladesRepository, GroupesRepository $groupesRepository): Response
    {
        return $this->render('main/index.groupe.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'groupes' => $groupesRepository->findAll(),
        ]);
    }
    #[Route('/noscontact', name: 'contact')]
    public function contact (BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.contacter.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }
    #[Route('/nosbalades', name: 'balades')]
    public function balade (BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.balades.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }
    #[Route('/envoieconfirme', name: 'confirmer')]
    public function confimer (BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/confirmer.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }
}
