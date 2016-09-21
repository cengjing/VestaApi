<?php

namespace VestaApi\Entity\OAuth\Repository;

use VestaApi\Entity\OAuth\AccessToken;
use Doctrine\ORM\EntityRepository;
use OAuth2\Storage\AccessTokenInterface;

class AccessTokenRepository extends EntityRepository implements AccessTokenInterface
{
    public function getAccessToken($oauthToken)
    {
        $token = $this->findOneBy(['token' => $oauthToken]);
        if ($token) {
            $token = $token->toArray();
            $token['expires'] = $token['expires']->getTimestamp();
        }
        return $token;
    }

    public function setAccessToken($oauthToken, $clientIdentifier, $userEmail, $expires, $scope = null)
    {
        $client = $this->_em->getRepository('VestaApi\Entity\OAuth\Client')
            ->findOneBy(['client_identifier' => $clientIdentifier]);

        $user = $this->_em->getRepository('VestaApi\Entity\OAuth\User')
            ->findOneBy(['email' => $userEmail]);
        $token = AccessToken::fromArray([
            'token'     => $oauthToken,
            'client'    => $client,
            'user'      => $user,
            'expires'   => (new \DateTime())->setTimestamp($expires),
            'scope'     => $scope,
        ]);

        $this->_em->persist($token);
        $this->_em->flush();
    }
}