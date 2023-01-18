<?php

namespace App\Controller;

use App\Entity\Dangers;
use App\Form\DangersType;
use App\Repository\DangersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dangers')]
class DangersController extends AbstractController
{
    #[Route('/', name: 'app_dangers_index', methods: ['GET'])]
    public function index(DangersRepository $dangersRepository): Response
    {
        return $this->render('dangers/index.html.twig', [
            'dangers' => $dangersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dangers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DangersRepository $dangersRepository): Response
    {
        $danger = new Dangers();
        $form = $this->createForm(DangersType::class, $danger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dangersRepository->save($danger, true);

            return $this->redirectToRoute('app_dangers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dangers/new.html.twig', [
            'danger' => $danger,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dangers_show', methods: ['GET'])]
    public function show(Dangers $danger): Response
    {
        return $this->render('dangers/show.html.twig', [
            'danger' => $danger,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dangers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dangers $danger, DangersRepository $dangersRepository): Response
    {
        $form = $this->createForm(DangersType::class, $danger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dangersRepository->save($danger, true);

            return $this->redirectToRoute('app_dangers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dangers/edit.html.twig', [
            'danger' => $danger,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dangers_delete', methods: ['POST'])]
    public function delete(Request $request, Dangers $danger, DangersRepository $dangersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$danger->getId(), $request->request->get('_token'))) {
            $dangersRepository->remove($danger, true);
        }

        return $this->redirectToRoute('app_dangers_index', [], Response::HTTP_SEE_OTHER);
    }
}
