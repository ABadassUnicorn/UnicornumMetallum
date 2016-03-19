<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Admin\Model;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Route\RouteCollection;

class UserAdmin extends Admin {

    protected function configureRoutes(RouteCollection $collection) {
        $collection->remove('show');
    }

    public function getExportFormats() {
        return array('xls', 'csv');
    }

    /**
     * {@inheritdoc}
     */
    public function getFormBuilder() {
        $this->formOptions['data_class'] = $this->getClass();

        $options = $this->formOptions;
        $options['validation_groups'] = (!$this->getSubject() || is_null($this->getSubject()->getId())) ? 'Registration' : 'Profile';

        $formBuilder = $this->getFormContractor()->getFormBuilder($this->getUniqid(), $options);

        $this->defineFormBuilder($formBuilder);

        return $formBuilder;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
                ->add('createdAt', 'date', array(
                    'label' => 'Date d\'inscription',
                    'widget' => 'single_text',
                    'format' => 'd-m-Y H:i:s'))
                ->addIdentifier('fullname', 'string', array(
                    'label' => 'Nom et Prénom',
                    'template' => 'FreeHandiseTrophyCacAdminBundle:Admin:nom_utilisateur.html.twig'
                ))
                ->add('profil', null, array('label' => 'Profil'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper) {
        $filterMapper
                ->add('createdAt', 'doctrine_orm_callback', array('label' => 'Date',
                    // Callback pour le filtre sur la date:
// on va chercher tous les utilisateurs inscrits la journée saisie
                    'callback' => function ($queryBuilder, $alias, $field, $value) {
                        if (!$value['value']) {
                            return;
                        }
                        $startTime = $value['value'];
                        $endTime = clone $startTime;
                        $endTime->add(new \DateInterval('P1D'));
                        $queryBuilder->andWhere("$alias.createdAt >= :StartDate");
                        $queryBuilder->setParameter('StartDate', $startTime);
                        $queryBuilder->andWhere("$alias.createdAt < :EndDate");
                        $queryBuilder->setParameter('EndDate', $endTime);

                        return true;
                    },), 'sonata_type_date_picker', array())
                ->add('lastname')
                ->add('firstname')
                ->add('groups', null, array('label' => 'Profil'))
                ->add('enabled', null, array('label' => 'Activé'))
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper) {
        $showMapper
                ->with('Utilisateur')
                ->add('createdAt')
                ->add('lastname')
                ->add('firstname')
                ->add('email')
                ->add('groups', null, array('label' => 'Profil'))
                ->add('enabled', null, array('label' => 'Activé'))
                ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        if ($this->getRequest()->get($this->getIdParameter())) {
// case of edition
            $isNew = false;
        } else {
            $isNew = true;
        }
        if ($isNew == true) {
            $formMapper
                    ->with('Inscription')
                    ->add('profil', 'choice', array('choices' => array('Administrateur' => 'Administrateur'),
                        'label' => 'Profil',
                        'disabled' => true));
        } else {
            $formMapper
                    ->with('Inscription')
                    ->add('groups', null, array(
                        'label' => 'Profil',
                        'disabled' => false
            ));
        }
        $formMapper
                ->add('lastname', null, array(
                    'required' => true,
                ))
                ->add('firstname', null, array(
                    'required' => true,
                ))
                ->add('email');
        if ($isNew == true) {
            $formMapper
                    ->add('plainPassword', 'text', array(
                        'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
            ));
        }
        $formMapper->add('enabled', null, array(
            'label' => 'Activé',
            'required' => false,
        ));
        $formMapper
                ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user) {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }
    
    /**
     * {@inheritdoc}
     */
    public function prePersist($user) {
      if( $user->getProfil() === 'Administrateur'){
        $user->setEnabled(true);
      }
    }

    /**
     * @param UserManagerInterface $userManager
     */
    public function setUserManager(UserManagerInterface $userManager) {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager() {
        return $this->userManager;
    }

    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt'
    );

    public function getNewInstance() {
        $instance = parent::getNewInstance();
        $em = $this->getModelManager()->getEntityManager('Application\Sonata\UserBundle\Entity\Group');
        $repository = $this->getModelManager()->getEntityManager('Application\Sonata\UserBundle\Entity\Group')->getRepository('Application\Sonata\UserBundle\Entity\Group');
        $profilQuery = $em->createQueryBuilder();
        $profilQuery->select('g')
                ->from('ApplicationSonataUserBundle:Group', 'g')
                ->where('g.name =:profil')
                ->setParameter('profil', 'Administrateur');
        $profil = $profilQuery->getQuery()->getSingleResult();
        $instance->addGroup($profil);
        return $instance;
    }

}
