<?php

namespace App\Controller;

use DateTime;
use App\Entity\Dogs;
use App\Form\DogsType;
use App\Entity\Balades;
use App\Form\BaladesType;
use App\Repository\BaladesRepository;
use App\Repository\ActivitesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/balades')]
class BaladesController extends AbstractController
{
    #[Route('/', name: 'app_balades_index', methods: ['GET'])]
    public function index(BaladesRepository $baladesRepository, ActivitesRepository $activitesRepository): Response
    {
        return $this->render('balades/index.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'activites' => $activitesRepository->findAll(),
        ]);
    }
    #[Route('/créationbalade', name: 'app_balades_création', methods: ['GET'])]
    public function création(BaladesRepository $baladesRepository, ActivitesRepository $activitesRepository): Response
    {
        return $this->render('balades/back.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'activites' => $activitesRepository->findAll(),
        ]);
    }
    

    #[Route('/new', name: 'app_balades_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BaladesRepository $baladesRepository, SluggerInterface $slugger): Response
    {
       
        $balade = new Balades();
        $form = $this->createForm(BaladesType::class, $balade);
        $form->handleRequest($request);
        
            if ($form->isSubmitted() && $form->isValid()) {

                $brochureFile = $form->get('photoBalade')->getData();
    
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
                            $this->getParameter('photo_direction'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    
                    }
                    // $time= new DateTime();
                    // $time->setTime(0,0,$request->timeBalade);
                    // $balade->setTimeBalade($time);


                    $balade->setPhotoBalade($newFilename);
                    $balade->setUser($this->getUser());
                    $baladesRepository->save($balade, true);
                 
                }
    
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
