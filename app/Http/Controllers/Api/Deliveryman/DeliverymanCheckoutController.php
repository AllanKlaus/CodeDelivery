<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Events\GetLocationDeliveryman;
use CodeDelivery\Models\Geo;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{

    private $repository, $userRepository, $productRepository;

    private $with = ['items','client', 'cupom'];

    public function __construct(
        OrderRepository $repository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    ){
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public  function index(){
        $id = Authorizer::getResourceOwnerID();
        $orders = $this->repository
            ->skipPresenter(false)
            ->with($this->with)->scopeQuery(function($query) use($id){
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();
        return $orders;
    }

    public function show($id){
        $idDeliveryman = Authorizer::getResourceOwnerID();
        return $this->repository
            ->skipPresenter(false)
            ->getByIdAndDeliveryman($id, $idDeliveryman);
    }

    public  function updateStatus(Request $request, $id){
        $idDeliveryman = Authorizer::getResourceOwnerID();
        return $this->orderService->updateStatus($id, $idDeliveryman, $request->get('status'));
    }

    public function geo(Request $request, Geo $geo, $id){
        $idDeliveryman = Authorizer::getResourceOwnerID();
        $order = $this->repository->getByIdAndDeliveryman($id, $idDeliveryman);
        $geo->lat = $request->get('lat');
        $geo->long = $request->get('long');
        event(new GetLocationDeliveryman($geo, $order));
        return $geo;
    }
}