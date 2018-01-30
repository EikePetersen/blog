<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditEntryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', TextType::class, array('label' => "Titel: ", "required" => true))
            ->add('content', TextareaType::class, array('label' => "Inhalt: ", "required" => true))
            ->add('save', SubmitType::class, array('label' => 'Bearbeiten'));
    }

}


?>