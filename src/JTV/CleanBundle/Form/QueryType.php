<?php

namespace JTV\CleanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class QueryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('query', 'text', array(
                                        'label'    => 'SearchQuery',
                                        'required' => true,
                                    ))
        ;
    }

    public function getName()
    {
        return 'jtv_cleanbundle_querytype';
    }
}
