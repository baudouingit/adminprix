<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Nomines;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Nomine controller.
 *
 * @Route("nomines")
 */
class NominesController extends Controller
{
    /**
     * Lists all nomine entities.
     *
     * @Route("/", name="nomines_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

//        $nomines = $em->getRepository('AppBundle:Nomines')->findAll();



        $nomines = $em->getRepository('AppBundle:Nomines')->findBy([], ['annee' => 'DESC', 'domaine' => 'ASC']);



        return $this->render('nomines/index.html.twig', array(
            'nomines' => $nomines,
        ));
    }

    /**
     * Creates a new nomine entity.
     *
     * @Route("/new", name="nomines_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $nomine = new Nomines();
        $form = $this->createForm('AppBundle\Form\NominesType', $nomine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($nomine);
            $em->flush();

            return $this->redirectToRoute('nomines_show', array('id' => $nomine->getId()));
        }

        return $this->render('nomines/new.html.twig', array(
            'nomine' => $nomine,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a nomine entity.
     *
     * @Route("/{id}", name="nomines_show")
     * @Method("GET")
     */
    public function showAction(Nomines $nomine)
    {
        $deleteForm = $this->createDeleteForm($nomine);

        return $this->render('nomines/show.html.twig', array(
            'nomine' => $nomine,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing nomine entity.
     *
     * @Route("/{id}/edit", name="nomines_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Nomines $nomine)
    {
        $deleteForm = $this->createDeleteForm($nomine);
        $editForm = $this->createForm('AppBundle\Form\NominesType', $nomine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nomines_edit', array('id' => $nomine->getId()));
        }

        return $this->render('nomines/edit.html.twig', array(
            'nomine' => $nomine,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a nomine entity.
     *
     * @Route("/{id}", name="nomines_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Nomines $nomine)
    {
        $form = $this->createDeleteForm($nomine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($nomine);
            $em->flush();
        }

        return $this->redirectToRoute('nomines_index');
    }

    /**
     * Creates a form to delete a nomine entity.
     *
     * @param Nomines $nomine The nomine entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nomines $nomine)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nomines_delete', array('id' => $nomine->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
