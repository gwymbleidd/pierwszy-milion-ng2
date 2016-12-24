<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\UserBundle\Doctrine\UserManager;
use JMS\Serializer\SerializerBuilder;
use AppBundle\Controller\JsonController;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use UserBundle\Entity\Config;
use UserBundle\Entity\AccessToken;
use UserBundle\Entity\RefreshToken;

class AccountController extends JsonController
{
    /**
     * @Route("/register")
     */
    public function registerAction(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);
        
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        
        if (!$requestData || !array_key_exists('username', $requestData) || !array_key_exists('email', $requestData) || !array_key_exists('password', $requestData))
        {
            return $this->JsonFail('Błędne dane');
        }

        if ($userManager->findUserByUsername($requestData['username']))
        {
            return $this->JsonFail('Nazwa użytkownika zajęta');
        }

        if ($userManager->findUserByUsernameOrEmail($requestData['email']))
        {
            return $this->JsonFail('Adres e-mail jest zajęty.');
        }

        $this->setUser($user, $requestData);
        
        $userManager->updateUser($user);

        return $this->JsonSuccess('Dodano użytkownika');
    }

    private function setUser($user, $requestData)
    {
        $em = $this->getDoctrine()->getManager();
        $user->setUsername(array_key_exists('username',$requestData) ? $requestData['username'] : $user->getUsername());
        $user->setEmail(array_key_exists('email',$requestData) ? $requestData['email'] : $user->getEmail());
        $user->setEnabled(array_key_exists('enabled',$requestData) ? $requestData['enabled'] : $user->isEnabled());

        if (array_key_exists('password',$requestData))
        {
            $userManager = $this->get('fos_user.user_manager');
            $user->setPlainPassword($requestData['password']);
            $userManager->updatePassword($user);
        }

        return $user;
    }
}
