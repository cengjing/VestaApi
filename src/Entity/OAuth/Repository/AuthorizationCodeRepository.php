<?php

namespace VestaApi\Entity\OAuth\Repository;

use VestaApi\Entity\OAuth\AuthorizationCode;
use Doctrine\ORM\EntityRepository;
use OAuth2\Storage\AuthorizationCodeInterface;

class AuthorizationCodeRepository extends EntityRepository implements AuthorizationCodeInterface
{
    public function getAuthorizationCode($code)
    {
        $authCode = $this->findOneBy(['code' => $code]);
        if ($authCode) {
            $authCode = $authCode->toArray();
            $authCode['expires'] = $authCode['expires']->getTimestamp();
        }
        return $authCode;
    }

    public function setAuthorizationCode($code, $clientIdentifier, $userEmail, $redirectUri, $expires, $scope = null)
    {
        $client = $this->_em->getRepository('VestaApi\Entity\OAuth\Client')
            ->findOneBy(array('client_identifier' => $clientIdentifier));

        $user = $this->_em->getRepository('VestaApi\Entity\OAuth\User')
            ->findOneBy(['email' => $userEmail]);

        $authCode = AuthorizationCode::fromArray([
            'code'           => $code,
            'client'         => $client,
            'user'           => $user,
            'redirect_uri'   => $redirectUri,
            'expires'        => (new \DateTime())->setTimestamp($expires),
            'scope'          => $scope,
        ]);

        $this->_em->persist($authCode);
        $this->_em->flush();
    }

    public function expireAuthorizationCode($code)
    {
        $authCode = $this->findOneBy(['code' => $code]);
        $this->_em->remove($authCode);
        $this->_em->flush();
    }
}