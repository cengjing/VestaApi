<?php

namespace VestaApi\Entity\Repository;

use VestaApi\Entity\AccessToken;
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

    public function setAccessToken($oauthToken, $clientIdentifier, $userId, $expires, $scope = null)
    {
        $client = $this->_em->getRepository('VestaApi\Entity\Client')
            ->findOneBy(['client_identifier' => $clientIdentifier]);

        $user = $this->_em->getRepository('VestaApi\Entity\User')
            ->findOneBy(['id' => $userId]);

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