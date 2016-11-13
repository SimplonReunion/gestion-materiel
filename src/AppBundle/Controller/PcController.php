<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Pc;
use AppBundle\Entity\Materiel;
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
        $materiel = new Materiel();

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
        $carteMere = array();
        $memoire = array();
        $radiateur = array();
        $systemeExploitation = array('Windows 10' => 'windows', 'Ubuntu' => 'ubuntu', 'Aucun' => 'aucun');
        $carteGraphique = array();
        $ecran = array();
        $autre = array();

        foreach ($materiels as $value) {

            $materielId = $value->getId();
            if ($value->getType() == "BOITIER") {
                $boitier[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "ALIMENTATION") {
                $alimentation[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "HDD") {
                $hdd[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "SSD") {
                $ssd[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "GRAVEUR") {
                $graveur[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "PROCESSEUR") {
                $processeur[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "CARTE MERE") {
                $carteMere[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "MEMOIRE") {
                $memoire[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "RADIATEUR") {
                $radiateur[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "CARTE GRAPHIQUE") {
                $carteGraphique[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "AUTRE") {
                $autre[$value->getIntitule()] = $materielId;
            }
        }

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
                    'choices' => $carteMere
                ))
                ->add('memoire', ChoiceType::class, array(
                    'choices' => $memoire
                ))
                ->add('radiateur', ChoiceType::class, array(
                    'choices' => $radiateur
                ))
                ->add('systemeExploitation', ChoiceType::class, array(
                    'choices' => $systemeExploitation
                ))
                ->add('carteGraphique', ChoiceType::class, array(
                    'choices' => $carteGraphique
                ))
                ->add('ecran', ChoiceType::class, array(
                    'choices' => $ecran
                ))
                ->add('vendable', ChoiceType::class, array(
                    'choices' => ($isRoleChef ? array('pret à être vendu' => 'pret à être vendu', 'à vendre' => 'à vendre') : array('pret à être vendu' => 'pret à être vendu', 'non classé' => 'non classé'))
                ))
                ->add('prix')
                ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $types = array('boitier', 'alimentation', 'hdd', 'ssd', 'graveur', 'processeur', 'carteMere', 'memoire', 'radiateur', 'systemeExploitation', 'carteGraphique', 'ecran');

            $typeId = array();
            foreach ($types as $type) {
                $typeId[] = $form[$type]->getData();
            }

            $materiels = $em->getRepository('AppBundle:Materiel')->findBy(['id' => $typeId]);

            foreach ($materiels as $value) {
                $value->setDisponible(0);
            }

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
    private function createDeleteForm(Pc $pc) {
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

        $materiel = new Materiel();
        // $deleteForm = $this->createDeleteForm($pc);
        // Get our "authorization_checker" Object
        $auth_checker = $this->get('security.authorization_checker');
        // Check for Roles on the $auth_checker
        $isRoleChef = $auth_checker->isGranted('ROLE_CHEF_ATELIER');
        // Test if user have ROLE_CHEF_ATELIER
        $isRoleTech = $auth_checker->isGranted('ROLE_TECH');


        $em = $this->getDoctrine()->getManager();
        $materiels = $em->getRepository('AppBundle:Materiel')->findBy(['disponible' => 1]);

        $boitier = array($pc->getBoitier() => $pc->getBoitier());
        $alimentation = array($pc->getAlimentation() => $pc->getAlimentation());
        $hdd = array($pc->getHdd() => $pc->getHdd());
        $ssd = array($pc->getSsd() => $pc->getSsd());
        $graveur = array($pc->getGraveur() => $pc->getGraveur());
        $processeur = array($pc->getProcesseur() => $pc->getProcesseur());
        $carteMere = array($pc->getCarteMere() => $pc->getCarteMere());
        $memoire = array($pc->getMemoire() => $pc->getMemoire());
        $radiateur = array($pc->getRadiateur() => $pc->getRadiateur());
        $systemeExploitation = array_unique(array(ucfirst($pc->getSystemeExploitation()) => $pc->getSystemeExploitation(), 'Windows 10' => 'windows', 'Ubuntu' => 'ubuntu', 'Aucun' => 'aucun'));
        $carteGraphique = array($pc->getCarteGraphique() => $pc->getCarteGraphique());
        $ecran = array($pc->getEcran() => $pc->getEcran());
        $autre = array();



        foreach ($materiels as $value) {

            $materielId = $value->getId();
            if ($value->getType() == "BOITIER") {
                $boitier[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "ALIMENTATION") {
                $alimentation[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "HDD") {
                $hdd[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "SSD") {
                $ssd[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "GRAVEUR") {
                $graveur[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "PROCESSEUR") {
                $processeur[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "CARTE MERE") {
                $carteMere[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "MEMOIRE") {
                $memoire[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "RADIATEUR") {
                $radiateur[$value->getIntitule()] = $materielId;
            }
            if ($value->getType() == "CARTE GRAPHIQUE") {
                $carteGraphique[$value->getIntitule()] = $materielId;
            } if ($value->getType() == "AUTRE") {
                $autre[$value->getIntitule()] = $materielId;
            }
        }



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
                    'choices' => $carteMere
                ))
                ->add('memoire', ChoiceType::class, array(
                    'choices' => $memoire
                ))
                ->add('radiateur', ChoiceType::class, array(
                    'choices' => $radiateur
                ))
                ->add('systemeExploitation', ChoiceType::class, array(
                    'choices' => $systemeExploitation
                ))
                ->add('carteGraphique', ChoiceType::class, array(
                    'choices' => $carteGraphique
                ))
                ->add('ecran', ChoiceType::class, array(
                    'choices' => $ecran
                ))
                ->add('vendable', ChoiceType::class, array(
                    'choices' => ($isRoleChef ? array('pret à être vendu' => 'pret à être vendu', 'à vendre' => 'à vendre') : array('pret à être vendu' => 'pret à être vendu', 'non classé' => 'non classé'))
                ))
                ->add('prix')
                ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted()) {


            $types = array('boitier', 'alimentation', 'hdd', 'ssd', 'graveur', 'processeur', 'carteMere', 'memoire', 'radiateur', 'systemeExploitation', 'carteGraphique', 'ecran');

            $typeId = array();
            foreach ($types as $type) {
                $typeId[] = $form[$type]->getData();
            }

            $materiels = $em->getRepository('AppBundle:Materiel')->findBy(['id' => $typeId]);

            foreach ($materiels as $value) {
                $value->setDisponible(0);
            }

            $pc->setBoitier($form['boitier']->getData())
                    ->setAlimentation($form['alimentation']->getData())
                    ->setCarteGraphique($form['carteGraphique']->getData())
                    ->setCarteMere($form['carteMere']->getData())
                    ->setEcran($form['ecran']->getData())
                    ->setGraveur($form['graveur']->getData())
                    ->setHdd($form['hdd']->getData())
                    ->setMemoire($form['memoire']->getData())
                    ->setProcesseur($form['processeur']->getData())
                    ->setRadiateur($form['radiateur']->getData())
                    ->setSsd($form['ssd']->getData())
                    ->setSystemeExploitation($form['systemeExploitation']->getData())
                    ->setPrix($form['prix']->getData());


            $em = $this->getDoctrine()->getEntityManager();
            //$em->persist($pc);

            $em->flush();
            return $this->redirectToRoute('pc_index');
        }

        // Create the form view
        return $this->render('pc/edit.html.twig', array(
                    'pc' => $pc,
                    'edit_form' => $form->createView(),
                        //'delete_form' => $deleteForm->createView(),
        ));


        /* $deleteForm = $this->createDeleteForm($pc);

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
          )); */
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
