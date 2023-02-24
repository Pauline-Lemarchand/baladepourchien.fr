<?php

namespace App\Controller;

use App\Entity\Groupes;
use App\Form\GroupesType;
use App\Repository\GroupesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/groupes')]
class GroupesController extends AbstractController
{
    #[Route('/', name: 'app_groupes_index', methods: ['GET'])]
    public function index(GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('groupes/index.html.twig', [
            'groupes' => $groupesRepository->findAll(),
        ]);
    }
    #[Route('/demandegroupes', name: 'app_groupes_back', methods: ['GET'])]
    public function back(GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('groupes/back.html.twig', [
            'groupes' => $groupesRepository->findAll(),
        ]);
    }
    #[Route('/newgroupes', name: 'app_groupes_newg', methods: ['GET'])]
    public function newg(GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('groupes/back.new.html.twig', [
            'groupes' => $groupesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_groupes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $groupe = new Groupes();
        $form = $this->createForm(GroupesType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupesRepository->save($groupe, true);

            return $this->redirectToRoute('app_groupes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupes/new.html.twig', [
            'groupe' => $groupe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupes_show', methods: ['GET'])]
    public function show(Groupes $groupe, Request $request): Response
    { 
        
        
        return $this->render('groupes/show.html.twig', [
            'groupe' => $groupe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_groupes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Groupes $groupe, GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $form = $this->createForm(GroupesType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupesRepository->save($groupe, true);

            return $this->redirectToRoute('app_groupes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('groupes/edit.html.twig', [
            'groupe' => $groupe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_groupes_delete', methods: ['POST'])]
    public function delete(Request $request, Groupes $groupe, GroupesRepository $groupesRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        if ($this->isCsrfTokenValid('delete'.$groupe->getId(), $request->request->get('_token'))) {
            $groupesRepository->remove($groupe, true);
        }

        return $this->redirectToRoute('app_groupes_index', [], Response::HTTP_SEE_OTHER);
    }
}
