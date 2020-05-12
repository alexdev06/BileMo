<?php

namespace App\Controller;

use App\Entity\Phone;
use Swagger\Annotations as SWG;
use App\Repository\PhoneRepository;
use App\Pagination\PaginationFactory;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
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
     * @Rest\QueryParam(
     *      name="page",
     *      requirements="\d+",
     *      nullable=true,
     *      description="The page"
     * )
     * @Rest\View(
     *      statusCode = 200,
     *      serializerGroups = {"list"}
     * )
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns phones list",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Phone::class))
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when ressource is not found"
     * )
     * @SWG\Tag(name="phones")
     */
    public function list(PhoneRepository $phoneRepository, Request $request, PaginationFactory $paginationFactory)
    {
        $qb = $phoneRepository->qb();
        $paginatedCollection = $paginationFactory->createCollection($request, $qb, 'phone_list');

        return $paginatedCollection;
    }

    /**
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
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns product details",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Phone::class))
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
     *     description="Phone unique identification number"
     * )
     * @SWG\Tag(name="phones")
     */
    public function show(Phone $phone)
    {
        return $phone;
    }
}
