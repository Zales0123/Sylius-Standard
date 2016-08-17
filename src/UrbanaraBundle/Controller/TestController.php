<?php

namespace UrbanaraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Mateusz Zalewski <mateusz.zalewski@lakion.com>
 */
class TestController extends Controller
{
    /**
     * @return Response
     */
    public function checkStatusAction($client, $orderId)
    {
        return new Response($this->get('urbanara.shop_connector')->checkOrderStatus($client, $orderId));
    }

    /**
     * @param string $client
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function checkStatusesAction($client, Request $request)
    {
        $ordersIds = $request->query->get('ordersIds');

        return new JsonResponse($this->get('urbanara.shop_connector')->checkOrdersStatuses($client, $ordersIds));
    }
}
