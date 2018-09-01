<?php
/**
 * Created by IntelliJ IDEA.
 * User: arnauddebacker
 * Date: 1/09/18
 * Time: 12:06
 */

namespace App\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;


class AddTagsListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::SUBMIT => 'onPreSetData',
        );
    }

    public function onSubmit(FormEvent $event)
    {
        $book = $event->getData();
        $book->setTags([uniqid(), uniqid(), uniqid()]);

    }

}