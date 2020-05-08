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
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

class SecurityController extends AbstractFOSRestController
{

    /**
     *  To register an user as client of the API
     *  
     * @Rest\Post(
     *      path = "/api/register",
     *      name = "client_add",
     *  )
     * @ParamConverter(
     *      "client",
     *      converter="fos_rest.request_body"
     * )
     * @Rest\View(statusCode = 201)
     * 
     * @SWG\Response(
     *     response=400,
     *     description="Returned when impossible to create a client ressource: Validation problems"
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Returned when a client ressource has been created"
     * )
     * @SWG\Tag(name="security")
     */
    public function register(Client $client, EntityManagerInterface $entityManager, ConstraintViolationList $violations, UserPasswordEncoderInterface $encoder) 
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }

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
     *  To authenticate a registered client
     * 
     * @Rest\Post(
     *      path = "/api/login",
     *      name = "client_login",
     * )
     * 
     * @SWG\Response(
     *     response=401,
     *     description="Returned when login and/or password are wrong"
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Returns a token when authentication request is successfull"
     * )
     * @SWG\Tag(name="security")
     *
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
