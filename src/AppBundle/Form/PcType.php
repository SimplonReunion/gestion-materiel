<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class PcType extends AbstractType {


    private $authorization;

    public function __construct(AuthorizationChecker $authorizationChecker)
    {
        $this->authorization = $authorizationChecker;
    }
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('boitier')
                ->add('alimentation')
                ->add('hdd')
                ->add('ssd')
                ->add('graveur')
                ->add('processeur')
                ->add('carteMere')
                ->add('memoire')
                ->add('radiateur')
                ->add('systemeExploitation')
                ->add('carteGraphique')
                ->add('ecran')
                ->add('prix');
        if ($this->authorization->isGranted('ROLE_CHEF_ATELIER')) {
            $builder->add('vendable');

        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Pc'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_pc';
    }

}
