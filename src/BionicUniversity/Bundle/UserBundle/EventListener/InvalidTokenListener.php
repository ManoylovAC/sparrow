<?php

namespace BionicUniversity\Bundle\UserBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class InvalidTokenListener
{
    public function __construct(CsrfTokenManagerAdapter $csrfTokenManager)
    {
        $this->provider = $csrfTokenManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }
        $token = $event->getRequest()->get('_token');
        if (false !== strstr($event->getRequest()->attributes->get('_route'), 'fos')) {
            return;
        }
        if (false !== strstr($event->getRequest()->attributes->get('_route'), 'user_login')) {
            return;
        }
        if('GET' !== $event->getRequest()->getMethod()){
            return;
        }
        if (!$token) {
            throw new AccessDeniedException('Invalid token');
        }
        if ($token && (false === $this->provider->isCsrfTokenValid('anything', $token))) {
            throw new AccessDeniedException('Invalid token');
        }
    }
}
