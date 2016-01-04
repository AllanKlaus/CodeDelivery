<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\User;

/**
 * Class DeliverymanTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class DeliverymanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Deliveryman entity
     * @param \Deliveryman $model
     *
     * @return array
     */
    public function transform(Deliveryman $model) {
        return [
            'id'         => (int)$model->id,

            'name'         => (string)$model->name,
            'email'         => (string)$model->email,
            /* place your other model properties here */

//            'created_at' => $model->created_at,
//            'updated_at' => $model->updated_at
        ];
    }
}