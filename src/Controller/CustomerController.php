<?php

namespace App\Controller;

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

}
