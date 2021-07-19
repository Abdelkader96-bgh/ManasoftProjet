<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTimeImmutable;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Route("/equipment")
 */
class EquipmentController extends AbstractController
{
    /**
     * @Route("/", name="equipment_index", methods={"GET"})
     */
    public function index(EquipmentRepository $equipmentRepository): Response
    {
        return $this->render('equipment/index.html.twig', [
            'equipments' => $equipmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="equipment_new", methods={"GET","POST"})
     */
    public function new(Request $request,ValidatorInterface $validator): Response
    {
        $equipment = new Equipment();
        $equipment->setCreatedAt(new \DateTimeImmutable());
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipment);
            $entityManager->flush();

            return $this->redirectToRoute('equipment_index');
        }
        $errors = $validator->validate($equipment);
        if (count($errors) > 0) {
           
           
        return $this->render('equipment/new.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
   }  }
  

    /**
     * @Route("/{id}", name="equipment_show", methods={"GET"})
     */
    public function show(Equipment $equipment): Response
    {
        return $this->render('equipment/show.html.twig', [
            'equipment' => $equipment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="equipment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipment $equipment): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment);
        $form->handleRequest($request);
        $equipment->setUpdateAt(new DateTimeImmutable);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('equipment_index');
        }

        return $this->render('equipment/edit.html.twig', [
            'equipment' => $equipment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="equipment_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipment $equipment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('equipment_index');
    }
}
