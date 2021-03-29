<?php

namespace App\Controller;

use App\Entity\Adresses;
use App\Entity\Annonces;
use App\Form\AdressesType;
use App\Form\AnnoncesType;
use App\Form\EditProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig');
    }
    /**
     * @Route("/users/annonces/ajout", name="users_annonces_ajout")
     */
    public function ajoutAnnonce(Request $request): Response
    {
        $annonce = new Annonces;
        $form = $this->createForm(AnnoncesType::class, $annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setUsers($this->getUser());
            $annonce->setActive(false);
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('users');
        };
        return $this->render('users/annonces/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/users/profil/modifier", name="users_profil_modifier")
     */
    public function editProfile(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('users');
        };
        return $this->render('users/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/users/pass/modifier", name="users_pass_modifier")
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $passwordencoder): Response
    {
        if ($request->isMethod('POST')) {

            $em = $this->getDoctrine()->getManager();
            $user = $this->getUser();

            //vérifier que  les 2 mots de passe sont identiques

            if ($request->request->get('pass') == $request->request->get('pass2')) {

                $user->setPassword($passwordencoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Le mot de passe a été mis à jour');

                return $this->redirectToRoute('users');
            } else {
                $this->addFlash('error', 'Les 2 mots de passe ne correspondent pas');
            }
        };
        return $this->render('users/editpass.html.twig');
    }

    /**
     * @Route("/users/profil/adresses", name="users_profil_adresses")
     */
    public function editAdresse(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(AdressesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $adresses = new Adresses;
            $test = $request->request->get('adresses');
            $adresses->setType($test['type']);
            $adresses->setNumero($test['numero']);
            $adresses->setTypevoie($test['typevoie']);
            $adresses->setPostalCode($test['postalCode']);
            $adresses->setLibelleVoie($test['libellevoie']);
            $adresses->setComplementAdresse($test['complementAdresse']);
            $adresses->setVille($test['ville']);
            $adresses->setCountry($test['country']);
            $adresses->setUsers($this->getUser('id'));

            $em->persist($adresses);
            $em->flush();

            $this->addFlash('message', 'Adresse mise à jour');
            return $this->redirectToRoute('users');
        };
        $adresses = $this->getDoctrine()
            ->getRepository(Adresses::class)
            ->findAll();

        return $this->render('users/adresses.html.twig',['adresses' => $adresses,'form' => $form->createView()]);
    }
}
