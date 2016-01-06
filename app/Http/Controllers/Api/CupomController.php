<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Repositories\CupomRepository;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class CupomController extends Controller
{

    private $repository;

    public function __construct(CupomRepository $repository){
        $this->repository = $repository;
    }

    public  function show($code){
        return $this->repository->skipPresenter(false)->findByCode($code);
    }
}
