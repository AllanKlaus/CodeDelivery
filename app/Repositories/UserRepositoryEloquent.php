<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Models\User;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    protected $skipPresenter = true;

    public function lists(){
//        return $this->model->lists('name', 'id');
        return $this->model->where(['role' => 'client'])->lists('name', 'id');
    }

    public function getDeliveryman(){
        return $this->model->where(['role' => 'deliveryman'])->lists('name', 'id');
    }

    public function model()
    {
        return User::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter(){
        return \CodeDelivery\Presenters\UserPresenter::class;
    }
}
