<?php

namespace OC\PlatformBundle\Form\Type;

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

class AdvertType extends AbstractType
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
            ->add('content', TextType::class)
//            ->add('published', CheckboxType::class, array('required' => false))
            ->add('image', ImageType::class)
            /*
              * Rappel :
              ** - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
              ** - 2e argument : type du champ, ici « collection » qui est une liste de quelque chose
              ** - 3e argument : tableau d'options du champ
              */
//            ->add('categories', CollectionType::class, array(
//                    'entry_type' => CategoryType::class,
//                    'allow_add' => true,
//                    'allow_delete' => true,
//                    'entry_options' => array(
//                        'required' => false,
//                        'attr' => array('class' => 'email-box')
//                        )
//                    )
//                )
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
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'oc_platformbundle_advert';
    }
}
