<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pc controller.
 *
 * @Route("pc")
 */
class PcController extends Controller {

    /**
     * Lists all pc entities.
     *
     * @Route("/", name="pc_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $pcs = $em->getRepository('AppBundle:Pc')->findAll();

        return $this->render('pc/index.html.twig', array(
                    'pcs' => $pcs,
        ));
    }

    /**
     * Creates a new pc entity.
     *
     * @Route("/new", name="pc_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $pc = new Pc();

        // Get our "authorization_checker" Object
       $auth_checker = $this->get('security.authorization_checker');
       // Check for Roles on the $auth_checker
       $isRoleChef = $auth_checker->isGranted('ROLE_CHEF_ATELIER');
       // Test if user have ROLE_CHEF_ATELIER
       $isRoleTech = $auth_checker->isGranted('ROLE_TECH');


        $em = $this->getDoctrine()->getManager();
        $materiels = $em->getRepository('AppBundle:Materiel')->findBy(['disponible' => 1]);

        $boitier = array();
        $alimentation = array();
        $hdd = array();
        $ssd = array();
        $graveur = array();
        $processeur = array();
        $carte_mere = array();
        $memoire = array();
        $radiateur = array();
        $systeme_exploitation = array();
        $carte_graphique = array();
        $ecran = array();
        $autre = array();
        $vendable = array();


        foreach ($materiels as $value) {
            if ($value->getType() == "BOITIER") {
                $boitier[$value->getIntitule()] = $value->getIntitule();
            }
            if ($value->getType() == "ALIMENTATION") {
                $alimentation[$value->getIntitule()] = $value->getIntitule();
            }
            if ($value->getType() == "HDD") {
                $hdd[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "SSD") {
                $ssd[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "GRAVEUR") {
                $graveur[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "PROCESSEUR") {
                $processeur[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "CARTE MERE") {
                $carte_mere[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "MEMOIRE") {
                $memoire[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "RADIATEUR") {
                $radiateur[$value->getIntitule()] = $value->getIntitule();
            }
            if ($value->getType() == "CARTE GRAPHIQUE") {
                $carte_graphique[$value->getIntitule()] = $value->getIntitule();
            } if ($value->getType() == "AUTRE") {
                $autre[$value->getIntitule()] = $value->getIntitule();
            }
        }
        if ($isRoleTech) {
          # code...
        $form = $this->createFormBuilder($pc)
                ->add('boitier', ChoiceType::class, array(
                    'choices' => $boitier
                ))
                ->add('alimentation', ChoiceType::class, array(
                    'choices' => $alimentation
                ))
                ->add('hdd', ChoiceType::class, array(
                    'choices' => $hdd
                ))
                ->add('ssd', ChoiceType::class, array(
                    'choices' => $ssd
                ))
                ->add('graveur', ChoiceType::class, array(
                    'choices' => $graveur
                ))
                ->add('processeur', ChoiceType::class, array(
                    'choices' => $processeur
                ))
                ->add('carteMere', ChoiceType::class, array(
                    'choices' => $carte_mere
                ))
                ->add('memoire', ChoiceType::class, array(
                    'choices' => $memoire
                ))
                ->add('radiateur', ChoiceType::class, array(
                    'choices' => $radiateur
                ))
                ->add('systemeExploitation', ChoiceType::class, array(
                    'choices' => $systeme_exploitation
                ))
                ->add('carteGraphique', ChoiceType::class, array(
                    'choices' => $carte_graphique
                ))
                ->add('ecran', ChoiceType::class, array(
                    'choices' => $ecran
                ))
                ->add('vendable', ChoiceType::class, array(
                    'choices' => array ('pret à être vendu' => 'pret à être vendu','non classé' => 'non classé')
                ))



                ->add('prix')
                ->getForm();
        $form->handleRequest($request);
      }
      if ($isRoleChef) {
        # code...
      $form = $this->createFormBuilder($pc)
              ->add('boitier', ChoiceType::class, array(
                  'choices' => $boitier
              ))
              ->add('alimentation', ChoiceType::class, array(
                  'choices' => $alimentation
              ))
              ->add('hdd', ChoiceType::class, array(
                  'choices' => $hdd
              ))
              ->add('ssd', ChoiceType::class, array(
                  'choices' => $ssd
              ))
              ->add('graveur', ChoiceType::class, array(
                  'choices' => $graveur
              ))
              ->add('processeur', ChoiceType::class, array(
                  'choices' => $processeur
              ))
              ->add('carteMere', ChoiceType::class, array(
                  'choices' => $carte_mere
              ))
              ->add('memoire', ChoiceType::class, array(
                  'choices' => $memoire
              ))
              ->add('radiateur', ChoiceType::class, array(
                  'choices' => $radiateur
              ))
              ->add('systemeExploitation', ChoiceType::class, array(
                  'choices' => $systeme_exploitation
              ))
              ->add('carteGraphique', ChoiceType::class, array(
                  'choices' => $carte_graphique
              ))
              ->add('ecran', ChoiceType::class, array(
                  'choices' => $ecran
              ))
              ->add('vendable', ChoiceType::class, array(
                  'choices' => array ('pret à être vendu' => 'pret à être vendu','à vendre' => 'à vendre')
              ))



              ->add('prix')
              ->getForm();
      $form->handleRequest($request);
    }






        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($pc);
            $em->flush();
            return $this->redirectToRoute('pc_index');
        }

        // Create the form view
        return $this->render('pc/new.html.twig', array(
                    'pc' => $pc,
                    'form' => $form->createView(),
        ));








        /* $pc = new Pc();
          $form = $this->createForm('AppBundle\Form\PcType', $pc);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($pc);
          $em->flush($pc);

          return $this->redirectToRoute('pc_show', array('id' => $pc->getId()));
          }

          return $this->render('pc/new.html.twig', array(
          'pc' => $pc,
          'form' => $form->createView(),
          )); */
    }

    /**
     * Finds and displays a pc entity.
     *
     * @Route("/{id}", name="pc_show")
     * @Method("GET")
     */
    public function showAction(Pc $pc) {
        $deleteForm = $this->createDeleteForm($pc);

        return $this->render('pc/show.html.twig', array(
                    'pc' => $pc,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to delete a pc entity.
     *
     * @param Pc $pc The pc entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pc $pc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pc_delete', array('id' => $pc->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing pc entity.
     *
     * @Route("/{id}/edit", name="pc_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pc $pc) {
        $deleteForm = $this->createDeleteForm($pc);
        $editForm = $this->createForm('AppBundle\Form\PcType', $pc);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('pc_edit', array('id' => $pc->getId()));
        }

        return $this->render('pc/edit.html.twig', array(
                    'pc' => $pc,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pc entity.
     *
     * @Route("/{id}", name="pc_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pc $pc) {
        $form = $this->createDeleteForm($pc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pc);
            $em->flush($pc);
        }

        return $this->redirectToRoute('pc_index');
    }

}
