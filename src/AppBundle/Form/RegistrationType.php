<?php
/**
 * Created by PhpStorm.
 * User: praktikant-dev
 * Date: 29.01.2018
 * Time: 16:08
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType

{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
 $builder->remove('email');
        $builder->remove('username');
        $builder->remove('plainPassword');
        $builder->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'E-Mail: ', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('username', null, array('label' => 'Nutzername: ', 'translation_domain' => 'FOSUserBundle'));
        $builder->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
            'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'Passwort: '),
            'second_options' => array('label' => 'Passwort wiederholen: '),
            'invalid_message' => 'fos_user.password.mismatch',
        ));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}