<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Repository\PhoneRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhoneController extends AbstractController
{
    /**
     * Return the phones list
     * 
     * @Rest\Get(
     *      path = "/api/phones",
     *      name = "phone_list"
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"list"}
     * )
     */
    public function list(PhoneRepository $phoneRepository)
    {
        return $phoneRepository->findAll();
    }

    /**
     * 
     * Return a unique phone identified by Id property
     * 
     * @Rest\Get(
     *      path = "/api/phones/{id}",
     *      name = "phone_show",
     *      requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"detail"}
     * )
     */
    public function show(Phone $phone)
    {
        return $phone;
    }
}
