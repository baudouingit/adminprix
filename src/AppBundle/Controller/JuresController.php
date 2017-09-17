<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Jures;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Jure controller.
 *
 * @Route("jures")
 */
class JuresController extends Controller
{
    /**
     * Lists all jure entities.
     *
     * @Route("/", name="jures_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jures = $em->getRepository('AppBundle:Jures')->findAll();

        return $this->render('jures/index.html.twig', array(
            'jures' => $jures,
        ));
    }

    /**
     * Creates a new jure entity.
     *
     * @Route("/new", name="jures_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jure = new Jures();
        $form = $this->createForm('AppBundle\Form\JuresType', $jure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jure);
            $em->flush();

            return $this->redirectToRoute('jures_show', array('id' => $jure->getId()));
        }

        return $this->render('jures/new.html.twig', array(
            'jure' => $jure,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jure entity.
     *
     * @Route("/{id}", name="jures_show")
     * @Method("GET")
     */
    public function showAction(Jures $jure)
    {
        $deleteForm = $this->createDeleteForm($jure);

        return $this->render('jures/show.html.twig', array(
            'jure' => $jure,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jure entity.
     *
     * @Route("/{id}/edit", name="jures_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Jures $jure)
    {
        $deleteForm = $this->createDeleteForm($jure);
        $editForm = $this->createForm('AppBundle\Form\JuresType', $jure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jures_edit', array('id' => $jure->getId()));
        }

        return $this->render('jures/edit.html.twig', array(
            'jure' => $jure,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jure entity.
     *
     * @Route("/{id}", name="jures_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Jures $jure)
    {
        $form = $this->createDeleteForm($jure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jure);
            $em->flush();
        }

        return $this->redirectToRoute('jures_index');
    }

    /**
     * Creates a form to delete a jure entity.
     *
     * @param Jures $jure The jure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jures $jure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jures_delete', array('id' => $jure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
