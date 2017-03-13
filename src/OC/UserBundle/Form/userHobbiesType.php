<?php

namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->remove('password')
        ;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'oc_platformbundle_user_edit';
    }
	
	public function getParent(){
		return new UserType();
	}
}
