<?php

namespace OC\UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\ChoiceList;

use OC\PlatformBundle\Form\ImageType;
use Symfony\Component\Validator\Constraints\Date;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translator = $options['translator'];

        $builder
            ->add('username', TextType::class, array('required' => true))
            ->add('lastname', TextType::class, array('required' => true))
            ->add('email', EmailType::class, array('required' => true))
            ->add('image', ImageType::class)
            ->add('dateNaissance', DateType::class,
                array(
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr' => array('class' => 'datepicker'),
                )
            )
//            ->add('enabled', CheckboxType::class, array('required' => false))
//            ->add('roles', ChoiceType::class,
//                array(
//                    'choices' =>
//                        array(
//                            "ROLE_ADMIN" => ' ADMIN',
//                            "ROLE_AUTEUR" => ' AUTEUR',
//                            "ROLE_MODERATEUR" => ' MODERATEUR'
//                        ),
//                    'required' => false,
//                    "multiple" => true,
//                    "expanded" => true
//                )
//            )
            ->add('preferences', EntityType::class, array(
                    'label' => $translator->trans('lg_preferences'),
                    'class' => 'OC\PlatformBundle\Entity\RefHobbies',
//                    'query_builder' => function($repository) use ($userId, $commercialId) {
//                        return $repository->findTiersFactureQuery($userId, $commercialId);
//                    },
                    'property' => 'preferences',
                    'empty_value' => 'lg_choisissez',
//                    'cascade_validation' => false,
                    'expanded' => true,
                    'multiple' => true,
                )
            )
            ->add('civilite', EntityType::class, array(
                    'label' => $translator->trans('lg_civilite'),
                    'class' => 'OC\PlatformBundle\Entity\RefCivilite',
//                    'query_builder' => function($repository) use ($userId, $commercialId) {
//                        return $repository->findTiersFactureQuery($userId, $commercialId);
//                    },
                    'property' => 'civilite',
                    'empty_value' => 'lg_choisissez',
//                    'cascade_validation' => false,
                    'expanded' => true,
                    'multiple' => false,
                    'required' => true
                )
            )
            ->add('departement', EntityType::class,
                array(
                    'label' => $translator->trans('lg_departement'),
                    'class' => 'OC\PlatformBundle\Entity\RefDepartement',
//                    'query_builder' => function($repository) use ($userId, $commercialId) {
//                        return $repository->findTiersFactureQuery($userId, $commercialId);
//                    },
                    'property' => 'concatenationDepartementNomDepartement',
                    'empty_value' => $translator->trans('lg.choisissez'),
//                    'cascade_validation' => false,
                    'expanded' => false,
                    'multiple' => false,
                    'required' => true
                )
            )
            ->add('preferenceDepartements', EntityType::class,
                array(
                    'label' => $translator->trans('lg_preferencesdepartement'),
                    'class' => 'OC\PlatformBundle\Entity\RefDepartement',
                    //                    'query_builder' => function($repository) use ($userId, $commercialId) {
                    //                        return $repository->findTiersFactureQuery($userId, $commercialId);
                    //                    },
                    'property' => 'concatenationDepartementNomDepartement',
                    'empty_value' => 'lg_choisissez',
                    //                    'cascade_validation' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true
                )
            )
            ->add('preferenceSexes', EntityType::class,
                array(
                    'label' => $translator->trans('lg_sexe'),
                    'class' => 'OC\PlatformBundle\Entity\RefCivilite',
                    //                    'query_builder' => function($repository) use ($userId, $commercialId) {
                    //                        return $repository->findTiersFactureQuery($userId, $commercialId);
                    //                    },
                    'property' => 'civilite',
                    'empty_value' => $translator->trans('lg.choisissez'),
                    //                    'cascade_validation' => false,
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true
                )
            )
        ;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $user = $event->getData();

            // si le user n'a rien envoyé
            if (null == $user) {
                return null;
            }
            // si on n'a pas de password et pas d'id user alors on est en création
            if (!$user->getPassword() || null === $user->getId()) {
                $event->getForm()->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe doivent correspondre',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
//                'first_options'  => array('label' => 'Password'),
//                'second_options' => array('label' => 'Repeat Password'),
                ));
//                    $event->getForm()->add('plainPassword', 'password', array('required' => true));
                $event->getForm()->add('save', 'submit', array('label' => 'Sauvegarder'));
            } else {
                $event->getForm()->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe doivent correspondre',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => false,
//                'first_options'  => array('label' => 'Password'),
//                'second_options' => array('label' => 'Repeat Password'),
                ));
//                    $event->getForm()->add('plainPassword', 'password', array('required' => false));
                $event->getForm()->add('save', 'submit', array('label' => 'Modifier'));
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
            'data_class' => 'OC\UserBundle\Entity\User',
            'translator' => null
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
