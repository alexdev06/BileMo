<?php

namespace App\Controller;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractFOSRestController
{

    /**
     * @Rest\Post(
     *      path = "/api/register",
     *      name = "client_add",
     *  )
     * @ParamConverter(
     *      "client",
     *      converter="fos_rest.request_body"
     * )
     * @Rest\View(statusCode = 201)
     */
    
    public function register(Client $client, EntityManagerInterface $entityManager, ConstraintViolationList $violations, UserPasswordEncoderInterface $encoder) 
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $client->setRegisteredAt(new \DateTime());
        $client->setPassword($encoder->encodePassword($client, $client->getPassword()));

        $entityManager->persist($client);
        $entityManager->flush();
        
        $data = [
            'status' => 201,
            'message' => 'Client has been created'
        ];

        return new JsonResponse($data, 201);
    }

    /**
     * @Rest\Post(
     *      path = "/api/login",
     *      name = "client_login",
     * )
    
     */
    public function login(Request $request)
    {
        $client = $this->getUser();
        return $this->json([
            'username' => $client->getUsername(),
            'roles' => $client->getRoles()
        ]);
    }
}
