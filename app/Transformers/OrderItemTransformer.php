<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\OrderItem;

/**
 * Class OrderItemTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderItemTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['products'];
    /**
     * Transform the \OrderItem entity
     * @param \OrderItem $model
     *
     * @return array
     */
    public function transform(OrderItem $model) {
        return [
//            'id'         => (int)$model->id,
            'price'      => (float)$model->price,
            'qtd'         => (int)$model->qtd,

            /* place your other model properties here */
//
//            'created_at' => $model->created_at,
//            'updated_at' => $model->updated_at
        ];
    }

    public function includeProducts(Order $model){
        return $this->collection($model->products, new ProductTransformer());
    }
}