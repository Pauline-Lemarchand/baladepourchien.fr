<?php

namespace App\Controller;

use App\Entity\Balades;
use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Service\MailService;
use App\Repository\BaladesRepository;
use App\Repository\GroupesRepository;
use App\Repository\ConseilsRepository;
use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\mailer;


class MainController extends AbstractController
{
    #[Route(' ', name: 'home')]
    public function index(BaladesRepository $baladesRepository, GroupesRepository $groupesRepository, ConseilsRepository $conseilsRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'groupes' => $groupesRepository->findAll(),
            'conseils' => $conseilsRepository->findAll(),
        ]);
    }
    #[Route('/nosconseils', name: 'conseils')]
    public function conseils(BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.conseils.html.twig', [
            'balades' => $baladesRepository->findAll(),

        ]);
    }
    #[Route('/nosgroupes', name: 'groupes')]
    public function groupes(BaladesRepository $baladesRepository, GroupesRepository $groupesRepository): Response
    {
        return $this->render('main/index.groupe.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'groupes' => $groupesRepository->findAll(),
        ]);
    }
    #[Route('/noscontact', name: 'contact')]
    public function contact(
        BaladesRepository $baladesRepository,
        ContactsRepository $contactsRepository,
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer
    ): Response {
        $contact = new Contacts();
        $form = $this->createForm(ContactsType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            // Email
            // $mailService->sendEmail(
            //     $contact->getEmail(),
            //     $contact->getSubject(),
            //     'emails/contact.html.twig',
            //     ['contact' => $contact]
            // );

            $email = (new Email())
                ->from('me@exemple.com')
                ->to('youo@exxemple.com')
                ->subject('test')
                ->text('test')
                ->html('test');
$mailer->send($email);


            $this->addFlash(
                'success',
                'Votre demande a été envoyé avec succès !'
            );

            return $this->redirectToRoute('contact');
        }
        // } else {
        //     $this->addFlash(
        //         'danger',
        //         $form->getErrors()
        //     );
        // }



        return $this->render('main/index.contacter.html.twig', [
            'balades' => $baladesRepository->findAll(),
            'contacts' => $contactsRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
    #[Route('/nosbalades', name: 'balades')]
    public function balade(BaladesRepository $baladesRepository): Response
    {
        return $this->render('main/index.balades.html.twig', [
            'balades' => $baladesRepository->findAll(),
        ]);
    }
    #[Route('/envoieconfirme', name: 'confirmer')]
    public function confimer(BaladesRepository $baladesRepository, Request $request): Response
    {
        // $userId = $request->request->get('user_id');

        // // Enregistrer l'ID de l'utilisateur dans la session
        // $session = $request->getSession();
        // $session->set('user_id', $userId);

        // // Rediriger vers la page suivante
        return $this->redirectToRoute('confirmer');
        return $this->render('main/confirmer.html.twig', [
            'balades' => $baladesRepository->findAll(),

        ]);
    }
}
