<?php

namespace App\Http\Controllers\API\Client\Delivery;


use App\Http\Controllers\API\Client\Base\ClientBaseResourceController;
use App\Services\Delivery\ClientDeliveryService;

class ClientDeliveryController extends ClientBaseResourceController
{
    /**
     * ClientCategoryController constructor.
     * @param ClientDeliveryService $service
     */
    public function __construct(ClientDeliveryService $service)
    {
        parent::__construct($service);
    }
}
