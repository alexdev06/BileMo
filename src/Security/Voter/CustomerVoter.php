<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['MANAGE'])
            && $subject instanceof \App\Entity\Customer;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var Customer $subject **/
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'MANAGE':
                if ($subject->getClient() == $user) {
                    return true;
                }
                break;

        }

        return false;
    }
}
