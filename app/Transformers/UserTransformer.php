<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\User;

/**
 * Class UserTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $avaliableIncludes = ['client'];
    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model) {
        return [
            'id'         => (int)$model->id,
            'name'         => (string)$model->name,
            'email'         => (string)$model->email,
            'role'         => (string)$model->role,
        ];
    }

    public function includeClient(User $model){
        if($model->client){
            return $this->item($model->client, new ClientTransformer());
        } else {
            return null;
        }
    }
}