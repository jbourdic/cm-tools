<?php
/**
 * Created by PhpStorm.
 * User: Narcoflik
 * Date: 01/11/14
 * Time: 11:01
 */

namespace JB\UserBundle\Auth;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use JB\UserBundle\Entity\Users;

class OAuthProvider extends OAuthUserProvider {
    protected $session, $doctrine, $admins;

    public function __construct($session, $doctrine, $service_container)
    {
        $this->session = $session;
        $this->doctrine = $doctrine;
        $this->container = $service_container;
    }

    public function loadUserByUsername($username)
    {

        $qb = $this->doctrine->getManager()->createQueryBuilder();
        $qb->select('u')
            ->from('JBUserBundle:Users', 'u')
            ->where('u.twitterId = :tid')
            ->setParameter('tid', $username)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();

        if (count($result)) {
            return $result[0];
        } else {
            return new User();
        }
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        //Data from Google response
        $twitter_id = $response->getUsername(); /* An ID like: 112259658235204980084 */
        $email = $response->getEmail();
        $username = $response->getNickname();
        $name = $response->getRealName();
        $avatar = $response->getProfilePicture();
        $roles = array('ROLE_USER');
        //set data in session
        $this->session->set('email', $email);
        $this->session->set('username', $username);
        $this->session->set('realname', $name);
        $this->session->set('avatar', $avatar);

        //Check if this Google user already exists in our app DB
        $qb = $this->doctrine->getManager()->createQueryBuilder();
        $qb->select('u')
            ->from('JBUserBundle:Users', 'u')
            ->where('u.twitterId = :tid')
            ->setParameter('tid', $twitter_id)
            ->setMaxResults(1);
        $result = $qb->getQuery()->getResult();
        //add to database if doesn't exists
        if (!count($result)) {
            $user = new Users();
            $user->setUsername($twitter_id);
            $user->setName($name);
            $user->setUsername($username);
            $user->setEmail($email);
            $user->setTwitterId($twitter_id);
            $user->setRoles($roles);

            //Set some wild random pass since its irrelevant, this is Google login
            $factory = $this->container->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword(md5(uniqid()), $user->getSalt());
            $user->setPassword($password);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();
        } else {
            $user = $result[0]; /* return User */
        }

        //set id
        $this->session->set('id', $user->getId());

        return $this->loadUserByUsername($response->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'JB\\UserBundle\\Entity\\Users';
    }
}

