<?php
/**
 * Created by PhpStorm.
 * User: praktikant-dev
 * Date: 30.01.2018
 * Time: 14:14
 */

namespace AppBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EntryType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', TextType::class, array('label' => "Titel: ", "required" => true))
            ->add('author', TextType::class, array('label' => "Autor: ", "required" => true))
            ->add('content', TextareaType::class, array('label' => "Inhalt: ", "required" => true))
            ->add('save', SubmitType::class, array('label' => 'Bearbeiten'));
    }
}
?>