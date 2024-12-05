<?php

namespace Kader\CommentBundle\Controller;

use Kader\CommentBundle\Entity\Comment;
use Kader\CommentBundle\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends AbstractController
{
    public function add(Request $request, EntityManagerInterface $em, string $context): Response
    {
        $comment = new Comment();
        $comment->setContext($context);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Commentaire ajouté avec succès !');
            return $this->redirectToRoute('comment_success');
        }

        return $this->render('@Comment/comment_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
