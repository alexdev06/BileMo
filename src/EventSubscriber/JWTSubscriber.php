<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpFoundation\Cookie;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

/**
 *  Creates a "BEARER" cookie wich contains JWT token informations when authentification is successfull
 * 
 */
class JWTSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            Events::AUTHENTICATION_SUCCESS => 'onAuthenticationSuccess'
        ];
    }

    public function onAuthenticationSuccess(AuthenticationSuccessEvent $event)
    {
        $eventData = $event->getData();
        if (isset($eventData['token'])) {
            $response = $event->getResponse();
            $jwt = $eventData['token'];
            $response->headers->setCookie(new Cookie("BEARER", $jwt, new \DateTime("+1 hour"), "/", null, true, true, false, 'strict'));
        }
   }
}