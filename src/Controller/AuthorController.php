<?php

namespace App\Controller;

use App\Entity\Author;
use App\Form\AuthorForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", methods={"GET"}, name = "author_list")
     */
    public function authorList(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $search_author = $request->query->get('search_author');
        $authors = $this->getDoctrine()->getRepository(Author::class)->findAllByAuthorName($request, $search_author);

        return $this->render('authors/author_list.html.twig', array(
            'authors' => $authors
        ));
    }

    /**
     * @Route("/author/new", methods={"GET", "POST"}, name="new_author")
     */
    public function newAuthor(Request $request, ValidatorInterface $validator)
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        $author = new Author();

        $form = $this->createForm(AuthorForm::class, $author);
        $form->handleRequest($request);
        $errors = $validator->validate($author);
        if($form->isSubmitted() && $form->isValid()){
            $author = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            $this->addFlash(
                'info',
                'Pomyślnie dodano autora'
            );
            return $this->redirectToRoute('author_list');
        }
        return $this->render('authors/new_author.html.twig', array(
            'form' => $form->createView(),
            'errors' => $errors
        ));
    }
    /**
     * @Route("/author/delete/{id}", methods = {"DELETE"})
     */
    public function delete(Request $request, $id){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($author);
        $entityManager->flush();

        $this->addFlash(
            'info',
            'Autor został usunięty'
        );

        $response = new Response();
        $response->send();
    }
}