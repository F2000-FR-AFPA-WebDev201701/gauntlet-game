<?php

use GameBundle\Entity\User;

namespace GameBundle\Form;

class RegisterType extends AbstractType {

    public function registerForm(FormBuilder $builder, array $options) {
        $builder
                ->add('pseudo', 'text', array('max_lenght' => 12, 'required' => true, label => 'pseudo'))
                ->add('password', 'password', array('max_lenght' => 12, 'required' => true, label => 'password'))
                ->add('email', 'email', array('max_lenght' => 50, 'required' => true, 'label' => 'email'))
                ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'les mots de passe ne correspondent pas',
                    'options' => array('label' => 'password'),
                    'first_name' => 'password',
                    'second_name' => 'passwordconfirm'
        ));
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Wmd\WatchMyDeskBundle\Entity\User'
        );
    }

    public function getName() {
        return 'user';
    }

}
