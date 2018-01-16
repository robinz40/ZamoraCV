<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Commentaire;
use AppBundle\Form\ArticleType;
use AppBundle\Form\CommentaireType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Form\FormMapper;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $presentations = $em->getRepository('AppBundle:Presentation')->findAll();
        return $this->render('AppBundle::presentation.html.twig', [
            'presentations' => $presentations
        ]);
    }

    public function presentationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $presentations = $em->getRepository('AppBundle:Presentation')->findAll();
        return $this->render('AppBundle::presentation.html.twig', [
            'presentations' => $presentations
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
        $em = $this->getDoctrine()->getManager();
        $realisations = $em->getRepository('AppBundle:Realisation')->findAll();
        return $this->render('AppBundle::realisations.html.twig', [
            'realisations' => $realisations
        ]);
    }

    public function blogAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findAll();
        return $this->render('AppBundle::blog.html.twig', [
            'articles' => $articles
        ]);
    }

    public function ArticleAction(Request $request, $id)
    {
        $commentaire = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($id);
        $commentaires= $em->getRepository('AppBundle:Commentaire')->findBy(['article' => $article]);
        $form = $this -> createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $prodToSave = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodToSave);
            $em->flush();

            return $this->redirectToRoute('article', ['id' => $id]);
        }
        return $this->render('AppBundle::article.html.twig', [
            'article' => $article,
            'commentaires' => $commentaires,
            'form' => $form->createView()
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

    public function addCommentaireAction(Request $request)
    {
        $commentaire = new Commentaire();

        $form = $this -> createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $prodToSave = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($prodToSave);
            $em->flush();

            return $this->redirectToRoute('article', ['article' => $commentaire->getArticle()]);
        }

        return $this -> render ('AppBundle::article.html.twig', array(
            'form' => $form->createView()
        ));
    }


}
