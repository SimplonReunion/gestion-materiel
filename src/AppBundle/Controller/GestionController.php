<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GestionController extends Controller
{

  /**
   * List all users
   * @Route("/list/users")
   */
  public function ListUsersAction()
  {

      $usersRepository = $this->getDoctrine()
                              ->getRepository('AppBundle:User');

      $listeUsers = $usersRepository->findAll();

      return $this->render('AppBundle:Gestion:list_users.html.twig', array(
          'listeUsers' => $listeUsers
      ));
  }

    /**
     * Gestion des rôles
     *
     * @Route("/Manage/{id}")
     */
    public function ManageAction($id, Request $request)
    {
      // Get our "authorization_checker" Object
     $auth_checker = $this->get('security.authorization_checker');
     // Check for Roles on the $auth_checker
     $isRoleChef = $auth_checker->isGranted('ROLE_CHEF_ATELIER');
     // Test if user have ROLE_CHEF_ATELIER
     if ($isRoleChef) {
         $em = $this->getDoctrine()->getManager();
         $user = $em->getRepository('AppBundle:User')->find($id);
         $editForm = $this->createFormBuilder($user)
                 ->add('username',TextType::class)
                 ->add('roles', ChoiceType::class , array(
                     'multiple' => true,
                     'expanded' => true,
                     'choices' => array(
                         'TECHNICIEN' => 'ROLE_TECHNICIEN',
                         'CHEF D\'ATELIER' => 'ROLE_CHEF_ATELIER',

                     ),
                 ))
                 ->getForm();
         $editForm->handleRequest($request);
         if ($editForm->isSubmitted() && $editForm->isValid()) {
             $em->flush();
             return $this->redirectToRoute('app_gestion_listusers');
         }
         $build['edit_form'] = $editForm->createView();

        return $this->render('AppBundle:Gestion:manage.html.twig', $build);
    }
  }
}
