<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentaireAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('contenu', TextType::class)
            ->add('article', 'entity', array('class' => 'AppBundle\Entity\Article', 'choice_label'=>'titre', 'label' => 'Article'))
            ->add('user', 'entity', array('class' => 'AppBundle\Entity\User', 'choice_label'=>'username', 'label' => 'User'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('contenu')
            ->add('article.titre')
            ->add('user.username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->add('contenu')->add('article.titre')->add('user.username');
    }
}