<?php
declare(strict_types=1);

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SubjectStoreRequest
 * @package App\Http\Requests\Project
 */
class SubjectStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return isAdmin();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'  => 'required|string',
            'price' => 'numeric'
        ];
    }


    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'  => trans('data.subject.subject'),
            'price' => trans('data.all.price')
        ];
    }
}
