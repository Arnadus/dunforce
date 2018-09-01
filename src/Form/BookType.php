<?php

namespace App\Form;

use App\Entity\Book;
use App\Form\EventListener\AddTagsListener;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('coverPicture')
            ->add('isbn')
            ->add('creationDate')
            ->add('tags')
            ->addEventSubscriber(new AddTagsListener())
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
