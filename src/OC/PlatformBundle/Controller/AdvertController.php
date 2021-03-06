<?php
// src/OC/PlatformBundle/Controller/AdvertController.php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\Entity\Commentaire;

use OC\UserBundle\Entity\User;

use OC\PlatformBundle\Form\AdvertType;
use OC\PlatformBundle\Form\AdvertEditType;
use OC\PlatformBundle\Form\CommentaireType;

use OC\UserBundle\Form\UserType;
use OC\UserBundle\Form\UserEditType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class AdvertController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function indexAction(Request $request)
    {

        $user = $this->getUser();
        // ...
        $em = $this->getDoctrine()->getManager();
        // on récupère notre entité selon l'id reçu
        $advertUser = $em->getRepository("OCPlatformBundle:Advert")->findPostUser($user->getId());
        $advert = new Advert();

        $form = $this->createForm(AdvertEditType::class, $advert);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $advert = $form->getData();
            $advert->setAuthor($this->getUser());
            $advert->setCreatedAt(new \DateTime());
            // comme c'est le manager qui récupère l'annonce on n'a pas besoin de faire de persist sur l'objet $advert
            // on enregistre
            $em->persist($advert);
            $em->flush();
            // redirection vers la vue de l'annonce en récupérant l'id de l'advert Créer
            return $this->redirect($this->generateUrl('oc_platform_home'));
        }
        // Et modifiez le 2nd argument pour injecter notre liste
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            'listAdvertsUser' => $advertUser,
            'form' => $form->createView()
        ));

    }

    /**
     * @param Request $request
     * @return Response
     */
    public function indexScrollAction(Request $request)
    {
        $page = $request->get('page', 1);
        $pageSetResult = $page * $this->getParameter('limite_pagination');
        $user = $this->getUser();
        // ...
        $em = $this->getDoctrine()->getManager();
        // on récupère notre entité selon l'id reçu
        $advertUser = $em->getRepository("OCPlatformBundle:Advert")->findPostUser($user->getId(), $pageSetResult);

        // Et modifiez le 2nd argument pour injecter notre liste
        return new JsonResponse(
            array(
                'view' => $this->renderView('OCPlatformBundle:Advert:indexScroll.html.twig', array(
                        'listAdvertsUser' => $advertUser,
                    )
                ),
                'last_page' => $page
            ));
    }

    public function menuAction()
    {
        $advert = $this->getDoctrine()->getRepository("OCPlatformBundle:Advert")->findAll();
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array(
            // Tout l'intérêt est ici : le contrôleur passe

            // les variables nécessaires au template !
            'listAdverts' => $advert
        ));
    }

    public function viewAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        // On récupère l'annonce $id
        $commentaire = new Commentaire();
        $advert = $em
            ->getRepository('OCPlatformBundle:Advert')
            ->getAdvertWithCategories($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        $listAdvertSkills = '';

        $form = $this->get('form.factory')->create(new CommentaireType(), $commentaire);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $advert->addCommentaire($form->getData());
            $commentaire->setAuthor($user);
            $commentaire->setCreatedAt(new \DateTime('now'));
            $commentaire->setUpdatedAt(new \DateTime('now'));
            $em->flush();

            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $id)));
        }

        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert,
            "listAdvertSkills" => $listAdvertSkills,
            "form" => $form->createView()
        ));
    }

    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // On crée un objet Advert
        $advert = $em->getRepository('OCPlatformBundle:Advert')
            ->find($id);

        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(AdvertEditType::class, $advert);

        // on vérifie que le submit est valide
        $form->handleRequest($request);
        // on vérifie que le formulaire est valide
        if ($form->isValid()) {
            $advert = $form->getData();
            $em = $this->getDoctrine()->getManager();
            // comme c'est le manager qui récupère l'annonce on n'a pas besoin de faire de persist sur l'objet $advert
            // on enregistre
            $em->flush();
            // message pour la vue de retour
            $request->getSession()->getFlashBag()->add('notice', 'Cette annonce a bien été modifier.');
            // redirection vers la vue de l'annonce en récupérant l'id de l'advert Créer
            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array(
            'form' => $form->createView(),
            'advert' => $advert
        ));
    }

    public function addAction(Request $request)
    {
        // On crée un objet Advert
        $advert = new Advert();

        // On crée le FormBuilder grâce au service form factory
        $form = $this->get('form.factory')->create(AdvertType::class, $advert);
        $user = $this->getUser();

        // on vérifie que le submit est valide
        $form->handleRequest($request);
        // on vérifie que le formulaire est valide
        if ($form->isValid()) {
            $advert = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $advert->setAuthor($user);
            $em->persist($advert);
            // on enregistre
            $em->flush();
            // message pour la vue de retour
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistré.');
            // redirection vers la vue de l'annonce en récupérant l'id de l'advert Créer
            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('OCPlatformBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id, Request $request)
    {
        // Connexion avec le manager
        $em = $this->getDoctrine()->getManager();

        // on récupère notre entité selon l'id reçu
        $advert = $em->getRepository("OCPlatformBundle:Advert")->find($id);
        // on récupère les compétences liées à notre annonce

        $form = $this->createFormBuilder()->getForm();
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        if ($form->handleRequest($request)->isValid()) {
            // pour chaque instance on supprime les compétences de l'annonce

            // on supprime l'annonce et l'image car etant liées à l'annnonce
            $em->remove($advert);
            $em->flush();
            // Message
            $request->getSession()->getFlashBag()->add('notice',
                'L\'annonce numéro ' . $id . ' vient d\'être supprimer.');
            // redirection vers la page d'accueil
            return $this->redirect($this->generateUrl('oc_platform_home'));
        }
        // Si la requête est en GET, on affiche une page de confirmation avant de supprimer
        return $this->render('OCPlatformBundle:Advert:delete.html.twig', array(
                'advert' => $advert,
                'form' => $form->createView()
            )
        );
    }

    function logoutAction()
    {
        return $this->redirect($this->generateUrl('fos_user_security_logout'));
    }

    function createAction(Request $request)
    {
        // On crée un objet Advert
        $user = new User();
        $options = array('translator' => $this->get('translator'));

        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(UserType::class, $user, $options);

        // on vérifie que le submit est valide
        $form->handleRequest($request);
        // on vérifie que le formulaire est valide
        if ($form->isValid()) {
            // on enregistre l'image
            // $user->getImage()->upload();
            // on appel notre manager pour enregistrer car new Advert
            $em = $this->getDoctrine()->getManager();
            $password = $form->get('password')->getData();
            $preferences = $form->get('preferences')->getData();

            foreach ($preferences as $preference) {
                $user->addPreference($preference);
            }
            // on persist l'annonce
            $user->setRoles(array('ROLE_USER'))->setPlainPassword($password)
                ->setEnabled(true);

            $em->persist($user);
            // on enregistre
            $em->flush();
            // message pour la vue de retour
            $request->getSession()->getFlashBag()->add('notice', 'Création du compte bien enregistré.');
            // redirection vers la vue de l'annonce en récupérant l'id de l'advert Créer
            return $this->redirect($this->generateUrl('oc_platform_editUser', array('id' => $user->getId())));
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('OCPlatformBundle:Advert:compte.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    function editCompteAction($id, Request $request)
    {
        // On crée un objet User
        $userManager = $this->get('fos_user.user_manager');
        $options = array('translator' => $this->get('translator'));

        $user = $userManager->findUserBy(array('id' => $id));
        // On crée le FormBuilder grâce au service form factory
        $form = $this->createForm(UserType::class, $user, $options);
        // on récupère le mot de passe du l'utilisateur
        $password = $user->getPassword();

        // on vérifie que le submit est valide
        $form->handleRequest($request);
        // on vérifie que le formulaire est valide
        if ($form->isValid()) {
            $newPassword = $form->get('password')->getData();
            // on enregistre
            if (!empty($newPassword)) {
                // set plain permet de crypter le nouveau mot de passe
                $user->setPlainPassword($form->get('password')->getData());
            } else {
                // setPassword va concerver le mot de passe crypter déjà existant
                $user->setPassword($password);
            }

            $userManager->updateUser($user);
            // message pour la vue de retour
            $request->getSession()->getFlashBag()->add('notice', 'Modification du compte bien enregistré.');
            // redirection vers la vue de l'annonce en récupérant l'id de l'advert Créer
            return $this->redirect($this->generateUrl('oc_platform_editUser', array('id' => $user->getId())));
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('OCPlatformBundle:Advert:compte.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    function deleteCompteAction($id, Request $request)
    {
        // On crée un objet User
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->findUserBy(array('id' => $id));
        // on vérifie que le formulaire est valide
        if ($request->isMethod("GET")) {
            $userManager->deleteUser($user);
            $request->getSession()->getFlashBag()->add('notice', 'Suppression du compte bien enregistré.');

            return $this->redirect($this->generateUrl('oc_platform_home'));
        }
        // return $this -> redirect($this->generateUrl('oc_platform_editUser',array('id'=>$user -> getId())));
    }

    function afficheUserAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();

        return $this->render('OCPlatformBundle:Advert:afficheUser.html.twig', array(
            'users' => $users
        ));
    }

    function candidatureAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // on récupère notre entité selon l'id reçu
        $application = new Application();

        $form = $this->get('form.factory')->create(new ApplicationType(), $application);
        $form->handleRequest($request);
        // on vérifie que le formulaire est valide
        if ($form->isValid()) {
            $advert = $em->getRepository("OCPlatformBundle:Advert")->find($id);
            $application->setAdvert($advert);
            $em->persist($application);
            $em->flush();
            return $this->redirect($this->generateUrl('oc_platform_view', array('id' => $advert->getId())));
        }
        return $this->render('OCPlatformBundle:Advert:candidature.html.twig', array('form' => $form->createView()));
    }

    function rechercheAction(Request $request)
    {
        $advert = new Advert();
        $em = $this->getDoctrine()->getManager();
        // on vérifie que le formulaire est valide
        if ($request->isMethod('post') and !empty($request->get('search'))) {
            $searchValue = $request->request->get('search');
            $adverts = $em->getRepository("OCPlatformBundle:Advert")->getSearch($searchValue);
            if (null !== $adverts) {
                return $this->render('OCPlatformBundle:Advert:afficheSearch.html.twig',
                    array('adverts' => $adverts, 'search' => $searchValue));
            } else {
                $request->getSession()->getFlashbag()->add('notice', 'Aucun résultat');
                return $this->redirect($this->generateUrl('oc_platform_home'));
            }
        }
        $request->getSession()->getFlashBag()->add('notice', 'Aucun résultat ou votre critère de recherche est vide');
        return $this->redirect($this->generateUrl('oc_platform_home'));
    }

}	
