<?php

namespace Kader\CommentBundle\Controller\Admin;

use Kader\CommentBundle\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentAdminController extends AbstractController
{
    public function list(EntityManagerInterface $em): Response
    {
        $comments = $em->getRepository(Comment::class)->findAll();

        return $this->render('@Comment/admin/list.html.twig', [
            'comments' => $comments,
        ]);
    }

    public function delete(EntityManagerInterface $em, int $id): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if (!$comment) {
            throw $this->createNotFoundException('Comment not found');
        }

        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('comment_admin_list');
    }

    public function edit(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $comment = $em->getRepository(Comment::class)->find($id);

        if (!$comment) {
            throw $this->createNotFoundException('Comment not found');
        }

        $form = $this->createForm(\User\CommentBundle\Form\CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('comment_admin_list');
        }

        return $this->render('@Comment/admin/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

