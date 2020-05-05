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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractFOSRestController
{

    /**
     * @Rest\Post(
     *      path = "/api/clients",
     *      name = "client_add",
     *  )
     * @ParamConverter(
     *      "client",
     *      converter="fos_rest.request_body"
     * )
     * @Rest\View(statusCode = 201)
     */
    
    public function register(Client $client, EntityManagerInterface $entityManager, ConstraintViolationList $violations) 
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

        $client ->setRegisteredAt(new \DateTime());
        $client->setRoles($client->getRoles());

        $entityManager->persist($client);
        $entityManager->flush();
        
        $data = [
            'status' => 201,
            'message' => 'Le client a été créé'
        ];

        return new JsonResponse($data, 201);
    }
}
