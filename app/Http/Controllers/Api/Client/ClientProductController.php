<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Repositories\ProductRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientProductController extends Controller
{

    private $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;
    }

    public  function index(){
        $products = $this->repository
            ->skipPresenter(false)
            ->all();
        return $products;
    }
}
