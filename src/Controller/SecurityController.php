<?php

namespace App\Controller;

use App\Entity\Client;
use Swagger\Annotations as SWG;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\ResourceValidationException;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractFOSRestController
{

    /**
     *  Registers an user as client of the API
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
     * @SWG\Parameter(
     *     name="datas",
     *     in="body",
     *     required=true,
     *     @Model(type=Client::class, groups={"add"})
     * )
     * @SWG\Tag(name="security")
     */
    public function register(Client $client, EntityManagerInterface $entityManager, ConstraintViolationList $violations, UserPasswordEncoderInterface $encoder) 
    {
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
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
     *  Authenticates a registered client
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
     *     description="Returned with a token when authentication request has been successfull"
     * )
     *  @SWG\Parameter(
     *     name="datas",
     *     in="body",
     *     required=true,
     *     @Model(type=Client::class, groups={"login"})
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
