<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 09/01/17
 * Time: 10:49 م
 */

namespace Date\AppBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstDate', 'date')
            ->add('secondDate', 'date')
            
        ;
    }

    public function getName()
    {

    }
}