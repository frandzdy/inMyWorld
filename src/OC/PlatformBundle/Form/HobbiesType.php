<?php

namespace OC\PlatformBundle\Form;

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
use OC\PlatformBundle\Entity;

class HobbiesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('date', DateType::class)
//            ->add('title', TextType::class)
//            ->add('author', TextType::class)
//            ->add('content', TextareaType::class)
//            ->add('published', CheckboxType::class, array('required' => false))
//            ->add('image', ImageType::class)
            /*
              * Rappel :
              ** - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
              ** - 2e argument : type du champ, ici « collection » qui est une liste de quelque chose
              ** - 3e argument : tableau d'options du champ
              */
            ->add('preference', EntityType::class, array(
                    'label' => 'lg_raison_sociale_',
                    'class' => 'OC\PlatformBundle\Entity\RefHobbies',
//                    'query_builder' => function($repository) use ($userId, $commercialId) {
//                        return $repository->findTiersFactureQuery($userId, $commercialId);
//                    },
                    'property' => 'preference',
                    'empty_value' => 'lg_choisissez',
//                    'cascade_validation' => false,
                'expanded' => true,
                'multiple' => true,
                )
            )
            ->add('save', SubmitType::class);

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
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_userpreferences';
    }
}
