<?php

namespace App\Http\Requests;

use App\Models\Grading_system;
use Illuminate\Foundation\Http\FormRequest;

class CreateGrading_systemRequest extends FormRequest
{
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
        return Grading_system::$rules;
    }
}
