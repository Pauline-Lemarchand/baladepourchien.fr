<?php

namespace App\Controller;

use App\Entity\Dogs;
use App\Form\DogsType;
use App\Repository\DogsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/dogs')]
class DogsController extends AbstractController
{
    #[Route('/', name: 'app_dogs_index', methods: ['GET'])]
    public function index(DogsRepository $dogsRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('dogs/index.html.twig', [
            'dogs' => $dogsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dogs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger,  DogsRepository $dogsRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $dog = new Dogs();
        $form = $this->createForm(DogsType::class, $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
           


            $brochureFile = $form->get('photoDog')->getData();

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
                        $this->getParameter('photo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                
                }

               
                $dog->setPhotoDog($newFilename);
                $dog->setUser($this->getUser());
                $dogsRepository->save($dog, true);
         

            }

            
            

            return $this->redirectToRoute('app_dogs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dogs/new.html.twig', [
            'dog' => $dog,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dogs_show', methods: ['GET'])]
    public function show(Dogs $dog): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        return $this->render('dogs/show.html.twig', [
            'dog' => $dog,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dogs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dogs $dog, DogsRepository $dogsRepository): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        $form = $this->createForm(DogsType::class, $dog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dogsRepository->save($dog, true);

            return $this->redirectToRoute('app_dogs_show', array('id' => $dog->getId()), Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dogs/edit.html.twig', [
            'dog' => $dog,
            'form' => $form,
            
        ]);
    }

    #[Route('/{id}', name: 'app_dogs_delete', methods: ['POST'])]
    public function delete(Request $request, Dogs $dog, DogsRepository $dogsRepository): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à accéder à cette page');
        }
        if ($this->isCsrfTokenValid('delete'.$dog->getId(), $request->request->get('_token'))) {
            $dogsRepository->remove($dog, true);
        }

        return $this->redirectToRoute('app_dogs_index', [], Response::HTTP_SEE_OTHER);
    }
}
