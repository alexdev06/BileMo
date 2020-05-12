<?php

namespace App\Controller;

use App\Entity\Phone;
use Swagger\Annotations as SWG;
use App\Repository\PhoneRepository;
use App\Representation\PaginatedCollection;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
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
    public function list(PhoneRepository $phoneRepository, Request $request)
    {
        $page = $request->query->get('page', 1);
        $qb = $phoneRepository->qb();
        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(5);
        $pagerfanta->setCurrentPage($page);
        $phones = [];
        foreach ($pagerfanta->getCurrentPageResults() as $result) {
            $phones[] = $result;
        }

        $route = 'phone_list';
        $routeParams = array();
        $createLinkUrl = function($targetPage) use ($route, $routeParams) {
            return $this->generateUrl($route, array_merge(
                $routeParams,
                array('page' => $targetPage)
            ));
        };
        $paginatedCollection = new PaginatedCollection($phones, $pagerfanta->getNbResults());
        $paginatedCollection->addLink('self', $createLinkUrl($page));
        $paginatedCollection->addLink('first', $createLinkUrl(1));
        $paginatedCollection->addLink('last', $createLinkUrl($pagerfanta->getNbPages()));
        if ($pagerfanta->hasNextPage()) {
            $paginatedCollection->addLink('next', $createLinkUrl($pagerfanta->getNextPage()));
        }
        if ($pagerfanta->hasPreviousPage()) {
            $paginatedCollection->addLink('prev', $createLinkUrl($pagerfanta->getPreviousPage()));
        }

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
