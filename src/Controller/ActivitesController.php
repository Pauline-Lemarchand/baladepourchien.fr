<?php

namespace App\Controller;

use App\Entity\Activites;
use App\Form\ActivitesType;
use App\Repository\ActivitesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


#[Route('/activites')]
class ActivitesController extends AbstractController
{
    #[Route('/', name: 'app_activites_index', methods: ['GET'])]
    public function index(ActivitesRepository $activitesRepository): Response
    {
        return $this->render('activites/index.html.twig', [
            'activites' => $activitesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activites_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivitesRepository $activitesRepository,SluggerInterface $slugger): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $activite = new Activites();
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $brochureFile = $form->get('emoji')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('emoji_direction'),
                        $newFilename
                    );
                } catch (FileException $e) {
                
                }
                // $time= new DateTime();
                // $time->setTime(0,0,$request->timeBalade);
                // $balade->setTimeBalade($time);


                $activite->setemoji($newFilename);
          
                $activitesRepository->save($activite, true);
             
            }

        return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('activites/new.html.twig', [
        'activite' => $activite,
        'form' => $form,
    ]);
}

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $activitesRepository->save($activite, true);

    //         return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('activites/new.html.twig', [
    //         'activite' => $activite,
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/{id}', name: 'app_activites_show', methods: ['GET'])]
    public function show(Activites $activite): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('activites/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activites_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activites $activite, ActivitesRepository $activitesRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $form = $this->createForm(ActivitesType::class, $activite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitesRepository->save($activite, true);

            return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/edit.html.twig', [
            'activite' => $activite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activites_delete', methods: ['POST'])]
    public function delete(Request $request, Activites $activite, ActivitesRepository $activitesRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        if ($this->isCsrfTokenValid('delete'.$activite->getId(), $request->request->get('_token'))) {
            $activitesRepository->remove($activite, true);
        }

        return $this->redirectToRoute('app_activites_index', [], Response::HTTP_SEE_OTHER);
    }
}
