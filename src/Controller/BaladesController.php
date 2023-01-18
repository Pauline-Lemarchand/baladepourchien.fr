<?php

namespace App\Controller;

use App\Entity\Balades;
use App\Form\BaladesType;
use App\Repository\BaladesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/balades')]
class BaladesController extends AbstractController
{
    #[Route('/', name: 'app_balades_index', methods: ['GET'])]
    public function index(BaladesRepository $baladesRepository): Response
    {
        return $this->render('balades/index.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_balades_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BaladesRepository $baladesRepository): Response
    {
        $balade = new Balades();
        $form = $this->createForm(BaladesType::class, $balade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baladesRepository->save($balade, true);

            return $this->redirectToRoute('app_balades_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('balades/new.html.twig', [
            'balade' => $balade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_balades_show', methods: ['GET'])]
    public function show(Balades $balade): Response
    {
        return $this->render('balades/show.html.twig', [
            'balade' => $balade,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_balades_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Balades $balade, BaladesRepository $baladesRepository): Response
    {
        $form = $this->createForm(BaladesType::class, $balade);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $baladesRepository->save($balade, true);

            return $this->redirectToRoute('app_balades_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('balades/edit.html.twig', [
            'balade' => $balade,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_balades_delete', methods: ['POST'])]
    public function delete(Request $request, Balades $balade, BaladesRepository $baladesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$balade->getId(), $request->request->get('_token'))) {
            $baladesRepository->remove($balade, true);
        }

        return $this->redirectToRoute('app_balades_index', [], Response::HTTP_SEE_OTHER);
    }
}
