<?php

namespace App\Controller;

use App\Entity\Check;
use App\Form\CheckType;
use App\Repository\CheckRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/check')]
class CheckController extends AbstractController
{
    #[Route('/', name: 'app_check_index', methods: ['GET'])]
    public function index(CheckRepository $checkRepository): Response
    {
        return $this->render('check/index.html.twig', [
            'checks' => $checkRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_check_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CheckRepository $checkRepository): Response
    {
        $check = new Check();
        $form = $this->createForm(CheckType::class, $check);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checkRepository->add($check, true);

            return $this->redirectToRoute('app_check_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('check/new.html.twig', [
            'check' => $check,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_check_show', methods: ['GET'])]
    public function show(Check $check): Response
    {
        return $this->render('check/show.html.twig', [
            'check' => $check,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_check_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Check $check, CheckRepository $checkRepository): Response
    {
        $form = $this->createForm(CheckType::class, $check);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checkRepository->add($check, true);

            return $this->redirectToRoute('app_check_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('check/edit.html.twig', [
            'check' => $check,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_check_delete', methods: ['POST'])]
    public function delete(Request $request, Check $check, CheckRepository $checkRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$check->getId(), $request->request->get('_token'))) {
            $checkRepository->remove($check, true);
        }

        return $this->redirectToRoute('app_check_index', [], Response::HTTP_SEE_OTHER);
    }
}
