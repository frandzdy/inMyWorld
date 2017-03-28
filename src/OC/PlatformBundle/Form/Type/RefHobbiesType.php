<?php

namespace OC\PlatformBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Validator\Constraints\Type;

class RefHobbiesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title', EntityType::class, array(
            // query choices from this entity
            'class' => 'OC\PlatformBundle\Entity\RefHobbies',
            // use the User.username property as the visible option string
            'choice_label' => 'title',
            // used to render a select box, check boxes or radios
             'multiple' => true,
             'expanded' => true,
            'by_reference' => false
        ));

        $builder->add('save', SubmitType::class);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA, function (FormEvent $event) {
//            $advert = $event->getData();
//
//            if (null == $advert)
//                return null;
//
//            if (!$advert->getPublished() || null === $advert->getId()) {
//                $event->getForm()->add('published', 'checkbox', array('required' => false));
//            } else {
//                $event->getForm()->add('published', 'checkbox', array('disabled' => true));
//            }
        }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\RefHobbies'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_refhobbies';
    }
}
