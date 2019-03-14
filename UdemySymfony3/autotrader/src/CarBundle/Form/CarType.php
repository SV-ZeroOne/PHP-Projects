<?php

namespace CarBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ]])
            ->add('year', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ]])
            ->add('navigation')
            ->add('description')
            ->add('model', EntityType::class, [
                'class' => 'CarBundle\Entity\Model',
                'required' => true])
            ->add('make', EntityType::class, [
                'class' => 'CarBundle\Entity\Make',
                'required' => true]);
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CarBundle\Entity\Car'
        ));
    }
}
