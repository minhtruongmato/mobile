<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;

class ProductRequest extends FormRequest
{
    private $action;

    function __construct(Route $route) {
        $this->action = $route;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'image' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'template_id' => 'required'
        ];
        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($rules['image']);
        }
        return $rules;
    }

    /**
     * [messages description]
     * @return [type] [description]
     */
    public function messages()
    {
        $messages = [
            'image.required' => 'Hình Ảnh không được trống',
            'title.required' => 'Họ Tên không được trống',
            'slug.required'  => 'Slug không được trống',
            'type_id.required' => 'Danh mục không được trống',
            'price.required' => 'Giá Sản Phẩm không được trống',
            'discount.required' => 'Giảm Giá không được trống',
            'template_id.required' => 'Cấu Hình không được trống',
        ];

        $action = $this->action->getActionMethod();
        if($action == 'update'){
            unset($messages['image.required']);
        }
        return $messages;
    }
}


