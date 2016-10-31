<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PcType extends AbstractType {

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
                ->add('prix')
                ->add('vendable')
        ;
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
