<?php

namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\ChoiceList;

use OC\PlatformBundle\Form\ImageType;

class UserType extends AbstractType
{
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text')
			->add('prenom','text')
			->add('dateNaissance','date')
			
            ->add('email','email')
			->add('image', new ImageType())
            ->add('enabled','checkbox',array('required' => false))
			->add('roles', 'choice', array(
				'choices'   => array( 
					"ROLE_ADMIN"=>' ADMIN',
				    "ROLE_AUTEUR"=>' AUTEUR',
				    "ROLE_MODERATEUR"=>' MODERATEUR'
				),'required' => false,"multiple" => true,"expanded"=>true
			))
			->add('genre', 'choice', array(
				'choices'   => array( 
					"ROLE_ADMIN"=>' ADMIN',
				    "ROLE_AUTEUR"=>' AUTEUR',
				    "ROLE_MODERATEUR"=>' MODERATEUR'
				),'required' => false,"multiple" => true,"expanded"=>true
			))
        ;
		
		$builder -> addEventListener(
			FormEvents::PRE_SET_DATA,function(FormEvent $event){
				$user = $event -> getData();
				
				if(null == $user)
					return  null;
// 				
				if(!$user->getPassword() || null === $user -> getId()){
					$event -> getForm() -> add('password','password',array('required' => true));
					$event -> getForm() -> add('save','submit',array('label'=>'Sauvegarder'));
				}else{
					$event -> getForm() -> add('password','password',array('required' => FALSE));
					$event -> getForm() -> add('save','submit',array('label'=>'Modifier'));
				}
			}
		);
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'oc_userbundle_user';
    }
}
