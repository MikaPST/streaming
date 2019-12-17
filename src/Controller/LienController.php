<?php

namespace App\Controller;

use App\Entity\Lien;
use App\Form\LienType;
use App\Repository\LienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lien")
 */
class LienController extends AbstractController
{
    /**
     * @Route("/", name="lien_index", methods={"GET"})
     */
    public function index(LienRepository $lienRepository): Response
    {
        return $this->render('lien/index.html.twig', [
            'liens' => $lienRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lien_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lien = new Lien();
        $form = $this->createForm(LienType::class, $lien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lien);
            $entityManager->flush();

            return $this->redirectToRoute('lien_index');
        }

        return $this->render('lien/new.html.twig', [
            'lien' => $lien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lien_show", methods={"GET"})
     */
    public function show(Lien $lien): Response
    {
        return $this->render('lien/show.html.twig', [
            'lien' => $lien,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lien_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lien $lien): Response
    {
        $form = $this->createForm(LienType::class, $lien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lien_index');
        }

        return $this->render('lien/edit.html.twig', [
            'lien' => $lien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lien_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lien $lien): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lien->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lien_index');
    }
}
