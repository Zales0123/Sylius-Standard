<?php

namespace UrbanaraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
}
