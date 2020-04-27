<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;

class PhoneController extends AbstractController
{
    /**
     * Return the phones list
     * 
     * @Rest\Get(
     *      path = "/phones",
     *      name = "phone_list"
     * )
     * @Rest\View(statusCode = 200)
     */
    public function list(PhoneRepository $phoneRepository)
    {
        return $phoneRepository->findAll();
    }
}
