<?php

namespace App\Controller;

use App\Entity\Conseils;
use App\Form\ConseilsType;
use App\Repository\ConseilsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conseils')]
class ConseilsController extends AbstractController
{
    #[Route('/', name: 'app_conseils_index', methods: ['GET'])]
    public function index(ConseilsRepository $conseilsRepository): Response
    {
        return $this->render('conseils/index.html.twig', [
            'conseils' => $conseilsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conseils_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ConseilsRepository $conseilsRepository): Response
    {
        $conseil = new Conseils();
        $form = $this->createForm(ConseilsType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conseilsRepository->save($conseil, true);

            return $this->redirectToRoute('app_conseils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseils/new.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseils_show', methods: ['GET'])]
    public function show(Conseils $conseil): Response
    {
        return $this->render('conseils/show.html.twig', [
            'conseil' => $conseil,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conseils_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conseils $conseil, ConseilsRepository $conseilsRepository): Response
    {
        $form = $this->createForm(ConseilsType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conseilsRepository->save($conseil, true);

            return $this->redirectToRoute('app_conseils_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseils/edit.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conseils_delete', methods: ['POST'])]
    public function delete(Request $request, Conseils $conseil, ConseilsRepository $conseilsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseil->getId(), $request->request->get('_token'))) {
            $conseilsRepository->remove($conseil, true);
        }

        return $this->redirectToRoute('app_conseils_index', [], Response::HTTP_SEE_OTHER);
    }
}
