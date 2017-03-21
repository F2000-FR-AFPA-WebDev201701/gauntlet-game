<?php

namespace GameBundle\Form;

use GameBundle\Entity\User;
//use Symfony\Component\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('pseudo', TextType::class, array('attr' => array('placeholder' => 'Pseudo', 'class' => 'text-center')))//, array('max_lenght' => 12, 'required' => true, 'label' => 'pseudo'))
                ->add('password', PasswordType::class, array('attr' => array('placeholder' => 'Password', 'class' => 'text-center')))//, array('max_lenght' => 12, 'required' => true, 'label' => 'password'))
                ->add('submit', SubmitType::class, array('attr' => array('class' => 'text-center')));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

    public function getName() {
        return 'user';
    }

}
