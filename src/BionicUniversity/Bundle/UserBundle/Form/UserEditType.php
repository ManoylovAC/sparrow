<?php

namespace BionicUniversity\Bundle\UserBundle\Form;

use BionicUniversity\Bundle\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array('disabled' => 'disabled'))
            ->add('lastName', 'text', array('disabled' => 'disabled'))
            ->add('email', 'text', array('disabled' => 'disabled'))
            ->add('position')
            ->add('department')
            ->add('gender', 'choice', array(
                    'choices' => array(User::GENDER_MALE => 'Male', User::GENDER_FEMALE => 'Female'),
                    'empty_value' => 'Choose user gender',
                    'empty_data' => null,
                    'disabled' => 'disabled'
                )
            )
            ->add('dateOfBirth', 'birthday', [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'disabled' => 'disabled'
            ]);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BionicUniversity\Bundle\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'bionicuniversity_bundle_userbundle_user';
    }
}