<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle::presentation.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function presentationAction(Request $request)
    {
        return $this->render('AppBundle::presentation.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function competencesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $competences = $em->getRepository('AppBundle:competence')->findAll();
        return $this->render('AppBundle::competences.html.twig', [
            'competences' => $competences
        ]);
    }


    public function realisationsAction(Request $request)
    {
        return $this->render('AppBundle::realisations.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function blogAction(Request $request)
    {
        return $this->render('AppBundle::blog.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function adduserAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setEnabled('true');

        $addForm = $this->createForm('AppBundle\Form\UserType', $user);
        $addForm->handleRequest($request);

        if ($addForm->isSubmitted() && $addForm->isValid()) {
            $newuser = $addForm->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($newuser);
            $em->flush();

            return $this->redirectToRoute('app');
        }

        return $this -> render ('AppBundle::add_user.html.twig', array(
            'form' => $addForm->createView()
        ));
    }


}
