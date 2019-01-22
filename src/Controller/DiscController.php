<?php

namespace App\Controller;

use App\Entity\Disc;
use App\Entity\Genre;
use App\Entity\Author;
use App\Form\DiscForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DiscController extends AbstractController
{
    /**
     * @Route("/disc", methods={"GET"}, name = "disc_list")
     */
    public function discList()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $discs = $this->getDoctrine()->getRepository(Disc::class)->findAll();

        return $this->render('discs/disc_list.html.twig', array(
            'discs' => $discs
        ));
    }

    /**
     * @Route("/disc/new", methods={"GET", "POST"}, name="new_disc")
     */
    public function newDisc(Request $request, ValidatorInterface $validator)
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

            return $this->redirectToRoute('disc_list');
        }
        return $this->render('discs/new_disc.html.twig', array(
            'form' => $form->createView()
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

        $response = new Response();
        $response->send();
    }


}