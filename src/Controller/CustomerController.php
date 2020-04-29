<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomerController extends AbstractController
{
    /**
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
}
