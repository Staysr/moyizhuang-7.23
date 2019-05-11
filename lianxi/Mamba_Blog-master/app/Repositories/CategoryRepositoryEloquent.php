<?php

namespace App\Repositories;


use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;

class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{

    /**
     * Specify model class name
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
     * @return mixed
     */
    public function getNestedList()
    {
        return $this->model->getNestedList('name', null, '&nbsp;&nbsp;&nbsp;&nbsp;');
    }

    /**
     * Store a newly resource.
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        if ($input['cate_id'] == 0) {
            return $this->model->create(['name' => $input['name']]) ? true : false;
        }

        $category = $this->model->find($input['cate_id']);

        if (!$category) {
            return false;
        }

        return $category->children()->create(['name' => $input['name']]) ? true : false;
    }

    /**
     * 分类修改
     * Update a category by id
     * @param array $attributes
     * @param $id
     * @return bool
     */

    public function update(array $attributes, $id)
    {
        $input['name'] = $attributes['name'];
        $parentId = $attributes['cate_id'];

        $category = $this->model->find($id);

        //该分类不存在
        if (!$category) {
            return false;
        }
        //修改分类名
        //Update the cate_name by id
        if (!parent::update($input, $id)) {
            return false;
        }

        if ($parentId != 0 && $category->parent_id != $parentId) {

            $parentCategory =  $this->model->find($parentId);

            if(!$parentCategory){
                return false;
            }

            if(!$category->makeChildOf($parentCategory)){
                return false;
            }

        } elseif ($category->parent_id != $parentId && $parentId == 0) {
            //顶级分类
            if(!$category->makeRoot()){
                return false;
            }
        }

        return true;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}