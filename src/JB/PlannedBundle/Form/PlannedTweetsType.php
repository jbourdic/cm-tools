<?php

namespace JB\PlannedBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlannedTweetsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('message', 'textarea')
            ->add('image')
            ->add('receiver')
            ->add('sendingDate','datetime')
            ->add('Valider', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JB\PlannedBundle\Entity\PlannedTweets'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jb_plannedbundle_plannedtweets';
    }
}
