<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Materiel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Materiel controller.
 *
 * @Route("materiel")
 */
class MaterielController extends Controller
{
    /**
     * Lists all materiel entities.
     *
     * @Route("/", name="materiel_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materiels = $em->getRepository('AppBundle:Materiel')->findAll();

        return $this->render('materiel/index.html.twig', array(
            'materiels' => $materiels,
        ));
    }

    /**
     * Creates a new materiel entity.
     *
     * @Route("/new", name="materiel_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $materiel = new Materiel();
        $form = $this->createForm('AppBundle\Form\MaterielType', $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush($materiel);

            return $this->redirectToRoute('materiel_show', array('id' => $materiel->getId()));
        }

        return $this->render('materiel/new.html.twig', array(
            'materiel' => $materiel,
            'form'     => $form->createView(),
        ));
    }

    /**
     * Finds and displays a materiel entity.
     *
     * @Route("/{id}", name="materiel_show")
     * @Method("GET")
     */
    public function showAction(Materiel $materiel)
    {
        $deleteForm = $this->createDeleteForm($materiel);

        return $this->render('materiel/show.html.twig', array(
            'materiel'    => $materiel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing materiel entity.
     *
     * @Route("/{id}/edit", name="materiel_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Materiel $materiel)
    {
        $deleteForm = $this->createDeleteForm($materiel);
        $editForm = $this->createForm('AppBundle\Form\MaterielType', $materiel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_edit', array('id' => $materiel->getId()));
        }

        return $this->render('materiel/edit.html.twig', array(
            'materiel'    => $materiel,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a materiel entity.
     *
     * @Route("/{id}", name="materiel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Materiel $materiel)
    {
        $form = $this->createDeleteForm($materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materiel);
            $em->flush($materiel);
        }

        return $this->redirectToRoute('materiel_index');
    }

    /**
     * Creates a form to delete a materiel entity.
     *
     * @param Materiel $materiel The materiel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materiel $materiel)
    {
        return $this->createFormBuilder()
                    ->setAction($this->generateUrl('materiel_delete', array('id' => $materiel->getId())))
                    ->setMethod('DELETE')
                    ->getForm();
    }
}
