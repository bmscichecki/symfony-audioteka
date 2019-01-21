<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre", methods={"GET"}, name="genre_list")
     */
    public function genreList()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $genres=$this->getDoctrine()->getRepository(Genre::class)->getAll();

        return $this->render('genres/genre_list.html.twig', array(
            'genre' => $genres
        ));
    }

    /**
     * @Route("/genre/new", methods = {"GET", "POST"}, name = "new_club")
     */
    public function newGenre(Request $request, ValidatorInterface $validator){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $genre = new Genre();
        $form = $this->createForm(GenreForm::class, $genre);
        $form->handleRequest($request);
        $errors = $validator->validate($genre);
        if($form->isSubmitted() && $form->isValid()){
            $genre = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($genre);
            $entityManager->flush();
            return $this->redirectToRoute('genre_list');
        }
        return $this->render('genres/new_genre.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }

    /**
     * @Route("/genre/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $genre = $this->getDoctrine()->getRepository(Genre::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($genre);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }
}