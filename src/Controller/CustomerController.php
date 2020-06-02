<?php

namespace App\Controller;

use App\Entity\Customer;
use Swagger\Annotations as SWG;
use App\Pagination\PaginationFactory;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\ResourceValidationException;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Validator\ConstraintViolationList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CustomerController extends AbstractFOSRestController
{
    /**
     * Returns the customers list
     * 
     * @Rest\Get(
     *      path = "/api/customers",
     *      name = "customer_list"
     * )
     * @Rest\QueryParam(
     *      name="page",
     *      requirements="\d+",
     *      nullable=true,
     *      description="The actual paginated page of customer list"
     * )
     * @Rest\QueryParam(
     *      name="filter",
     *      requirements="[a-zA-Z0-9]+",
     *      nullable=true,
     *      description="The keyword lastname filter"
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"list"}
     * )
     * 
     * @Cache(expires="+10 minutes")
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returned with the customer list",
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
    public function list(CustomerRepository $customerRepository, Request $request, PaginationFactory $paginationFactory)
    {
        $filter = $request->query->get('filter');
        $client = $this->getUser();
        $queryB = $customerRepository->queryB($client, $filter);
        $paginatedCollection = $paginationFactory->createCollection($request, $queryB, 'customer_list');

        return $paginatedCollection;
    }

    /**
     * Returns an unique customer details identified by its Id
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
     * @Cache(expires="+10 minutes")
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
     *     response=403,
     *     description="Returned when the authentified client try to show a customer who is not linked with"
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
        if (!$this->isGranted('MANAGE', $customer)) {
            throw $this->createAccessDeniedException('You are not authorized to access to this customer !');
        }

        return $customer;
    }

    /**
     * Creates a customer entity by deserialization of the request body JSON content. The customer object is saved in database
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
     *     description="Returned when a Customer ressource has been created",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Customer::class))
     *     )
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returned when impossible to create the customer ressource mainly due to validation problem"
     * )
     * @SWG\Tag(name="customers")
     */
    public function Add(Customer $customer, EntityManagerInterface $entityManager, ConstraintViolationList $violations)
    {
        if (count($violations)) {
            $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
            foreach ($violations as $violation) {
                $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
            }

            throw new ResourceValidationException($message);
        }

        $client = $this->getUser();
        $customer->setClient($client);
        $entityManager->persist($customer);
        $entityManager->flush();

        return $this->view($customer, Response::HTTP_CREATED, ['Location' => $this->generateUrl('customer_show', ['id' => $customer->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    
    }

    /**
     * Deletes a customer entity identified by its Id
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
     *     description="Returned when a Customer has been successfully deleted"
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
    public function delete(Customer $customer, EntityManagerInterface $entityManager)
    {
        if (!$this->isGranted('MANAGE', $customer)) {
            throw $this->createAccessDeniedException('Your are not authorized to delete this customer!');
        }
        
        $entityManager->remove($customer);
        $entityManager->flush();
        $response = new Response();
        
        return $response->setStatusCode(204);
    }
}
