<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Entity\Genre;
use App\Entity\Author;
use App\Entity\UserCatalog;
use App\Form\DiscForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscController extends AbstractController
{
    /**
     * @Route("/disc", methods={"GET"}, name = "disc_list")
     */
    public function discList(Request $request)
    {

        $search_title = $request->query->get('search_title');
        $discs = $this->getDoctrine()->getRepository(Disc::class)->findAllByDiscTitle($request, $search_title);

        return $this->render('discs/disc_list.html.twig', array(
            'discs' => $discs
        ));
    }

    /**
     * @Route("/disc/new", methods={"GET", "POST"}, name="new_disc")
     */
    public function newDisc(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $disc=new Disc();

        $form = $this->createForm(DiscForm::class, $disc);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $disc = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($disc);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Album pomyślnie dodany'
            );

            return $this->redirectToRoute('disc_list');
        }

        return $this->render('discs/new_disc.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/disc/edit/{id}", name="edit_disc")
     * Method({"GET", "POST"})
     */
    public function edit(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $disc = $this->getDoctrine()->getRepository(Disc::class)->find($id);
        $form = $this->createForm(DiscForm::class, $disc);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $this->addFlash(
                'update',
                'Edytowano pomyślnie'
            );

            return $this->redirectToRoute('disc_list');
        }
        return $this->render('discs/new_disc.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/disc/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $disc = $this->getDoctrine()->getRepository(Disc::class)->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($disc);
        $entityManager->flush();

        $this->addFlash(
            'info',
            'Album usunięty pomyślnie'
        );

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/disc/addToList/{id}", name = "addToUser")
     * Method({"GET"})
     */

    public function addToList(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $list = new UserCatalog();
        $disc = $this->getDoctrine()->getRepository(Disc::class)->find($id);
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            $list->setUserId($user);
            $list->setDiscId($disc);
            $entityManager->persist($list);
            $entityManager->flush();

        $this->addFlash(
            'info',
            'Dodano do listy'
        );



        /*$user = $this->container->get('security.token_storage')->getToken()->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            $list->setUserId($user);
            $list->setDiscId($disc);
            //dump($disc);
            $entityManager->persist($list);
            $entityManager->flush();*/
        //dump($disc);

        return $this->redirectToRoute('user_list');

    }

    /**
     * @Route("/disc/userList", methods = {"GET"}, name = "user_list")
     */
    public function userList(Request $request)
    {
        //$userId = $this->getUser()->getId();
        $userId = $this->container->get('security.token_storage')->getToken()->getUser();
        //$discId = $request->query->get('discId');
        $userCatalogs = $this->getDoctrine()->getRepository(UserCatalog::class)->findAllByID($request, $userId);

        return $this->render('lists/user_list.html.twig', array(
            'userCatalogs' => $userCatalogs
        ));
    }

    /**
     * @Route("userCatalog/delete/{id}", methods={"DELETE"})
     */
    public function deleteUserDisc($id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $userCatalog = $this->getDoctrine()->getRepository(UserCatalog::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($userCatalog);
        $entityManager->flush();

        $this->addFlash(
            'update',
            'Usunięto z listy'
        );

        $response = new Response();
        $response->send();
    }


}