<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\ClientRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

class CustomerController extends AbstractFOSRestController
{
    /**
     * Return the customers list
     * 
     * @Rest\Get(
     *      path = "/api/customers",
     *      name = "customer_list"
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"list"}
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns customer list",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Customer::class))
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when ressource is not found"
     * )
     * @SWG\Tag(name="customers")

     */
    public function list(CustomerRepository $customerRepository)
    {
        return $customerRepository->findAll();
    }

    /**
     * Return an unique customer identified by its Id
     * 
     * @Rest\Get(
     *      path = "/api/customers/{id}",
     *      name = "customer_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"detail"}
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns customer details",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Customer::class))
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when ressource is not found"
     * )
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Unique customer identification number"
     * )
     * @SWG\Tag(name="customers")
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Create a customer entity by deserialization of the request body JSON content. The customer object is saved in database.
     * 
     * @Rest\Post(
     *      path = "/api/customers",
     *      name = "customer_add",
     *  )
     * @ParamConverter("customer",
     *      converter="fos_rest.request_body",
     *      options={
     *          "validator"={"groups"="add"}
     *      }     
     * )
     * @Rest\View(statusCode = 201,
     *      serializerGroups = {"detail"}
     * )
     * 
     * @SWG\Response(
     *     response=201,
     *     description="Customer ressource created",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Customer::class))
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when impossible to create the customer ressource. Validation problem mainly"
     * )
     * @SWG\Tag(name="customers")
     */
    public function Add(Customer $customer, EntityManagerInterface $manager, ClientRepository $clientRepository, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            return $this->view($violations, Response::HTTP_BAD_REQUEST);
        }
        $client = $clientRepository->find(21);

        $customer->setClient($client);
        $customer->setRegisteredAt(new \DateTime());
        $manager->persist($customer);

        $manager->flush();

        return $this->view($customer, Response::HTTP_CREATED, ['Location' => $this->generateUrl('customer_show', ['id' => $customer->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    
    }

    /**
     * Delete a customer entity identified by its Id
     * 
     * @Rest\Delete(
     *      path = "/api/customers/{id}",
     *      name = "customer_delete",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode = 204)
     * 
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="Unique customer identification number"
     * )
     * @SWG\Response(
     *     response=204,
     *     description="Customer successfully deleted"
     * )
     * @SWG\Response(
     *     response=403,
     *     description="Returned when the authentified client try to delete a customer who is not linked with"
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when ressource is not found"
     * )
     * @SWG\Tag(name="customers")
     */
    public function delete(Customer $customer, EntityManagerInterface $manager)
    {
        $manager->remove($customer);
        $manager->flush();

        $response = new Response();
        return $response->setStatusCode(204);
    }
}
