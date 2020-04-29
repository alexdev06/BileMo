<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\ClientRepository;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CustomerController extends AbstractFOSRestController
{
    /**
     * Return the customers list
     * 
     * @Rest\Get(
     *      path = "/customers",
     *      name = "customer_list"
     * )
     * @Rest\View(statusCode = 200)
     */
    public function list(CustomerRepository $customerRepository)
    {
        return $customerRepository->findAll();
    }

    /**
     * Return an unique customer identified by its Id
     * 
     * @Rest\Get(
     *      path = "/customers/{id}",
     *      name = "customer_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode = 200)
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Create a customer entity by deserialization of the request body JSON content. The customer object is saved in database.
     * 
     * @Rest\Post(
     *      path = "/customers",
     *      name = "customers_add",
     *  )
     * @ParamConverter("customer", converter="fos_rest.request_body")
     * @Rest\View(statusCode = 201)
     */
    public function Add(Customer $customer, EntityManagerInterface $manager, ClientRepository $clientRepository)
    {
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
     *      path = "/customers/{id}",
     *      name = "customer_delete",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(statusCode = 204)
     */
    public function delete(Customer $customer, EntityManagerInterface $manager)
    {
        $manager->remove($customer);
        $manager->flush();

        $response = new Response();
        return $response->setStatusCode(204);
    }
}
