<?php

namespace Kinash\SportCalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ExerciseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description','textarea')
            ->add('weight','text')
            ->add('count','integer')
            ->add('date','date')
            ->add('time','time');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kinash\SportCalendarBundle\Entity\Exercise'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'kinash_sportcalendarbundle_exercise';
    }
}
