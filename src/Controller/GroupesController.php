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
        return $this->render('groupes/index.html.twig', [
            'groupes' => $groupesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_groupes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GroupesRepository $groupesRepository): Response
    {
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
    public function show(Groupes $groupe): Response
    {
        return $this->render('groupes/show.html.twig', [
            'groupe' => $groupe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_groupes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Groupes $groupe, GroupesRepository $groupesRepository): Response
    {
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
        if ($this->isCsrfTokenValid('delete'.$groupe->getId(), $request->request->get('_token'))) {
            $groupesRepository->remove($groupe, true);
        }

        return $this->redirectToRoute('app_groupes_index', [], Response::HTTP_SEE_OTHER);
    }
}
