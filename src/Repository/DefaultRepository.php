<?php


namespace SONFin\Repository;

use Illuminate\Database\Eloquent\Model;


class DefaultRepository implements RepositoryInterface
{
    private $modelClass;

    private $model;


    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
        $this->model = new $modelClass;
    }

    public function all(): array
    {
        return $this->model->all()->toArray();
    }

    public function create(array $data)
    {
        $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }

    public function update(int $id, array $data)
    {
        $model = $this->model->find($id);
        $model->fill($data);
        $model->save();
        return $this->model;
    }

    public function delete(int $id)
    {
        $model = $this->model->find($id);
        $model->delete();
    }

    public function find(int $id, bool $failIfNotExist = true)
    {
        return $failIfNotExist ? $this->_model->findOrFail($id) :
            $this->_model->find($id);

    }

    public function findByField(string $field, $value): array
    {
        return $this->model->where($field, '=', $value)->toArray();
    }
}