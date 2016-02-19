<?php

namespace OC\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
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
            ->add('date', 'date')
            ->add('title', 'text')
            ->add('author', 'text')
            ->add('content', 'textarea')
            ->add('published', 'checkbox', array('required' => false))
            ->add('image', new ImageType())
            /*
              * Rappel :
              ** - 1er argument : nom du champ, ici « categories », car c'est le nom de l'attribut
              ** - 2e argument : type du champ, ici « collection » qui est une liste de quelque chose
              ** - 3e argument : tableau d'options du champ
              */
            ->add('categories', CollectionType::class, array(
                    'entry_type' => new CategoryType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => array(
                        'required' => false,
                        'attr' => array('class' => 'email-box')
                        )
                    )
                )
            ->add('save', 'submit');

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $advert = $event->getData();

            if (null == $advert)
                return null;

            if (!$advert->getPublished() || null === $advert->getId()) {
                $event->getForm()->add('published', 'checkbox', array('required' => false));
            } else {
                $event->getForm()->add('published', 'checkbox', array('disabled' => true));
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
            'data_class' => 'OC\PlatformBundle\Entity\Advert'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'oc_platformbundle_advert';
    }
}
