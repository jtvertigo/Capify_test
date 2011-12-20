<?php

namespace JTV\CleanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class NotifiesType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('organization')
            ->add('dt')
            ->add('type')
        ;
    }

    public function getName()
    {
        return 'jtv_cleanbundle_notifiestype';
    }
}
