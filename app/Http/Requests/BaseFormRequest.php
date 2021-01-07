<?php

namespace App\Http\Requests;

/**
 * Base Validation rules for forms
 */

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;



abstract class BaseFormRequest extends FormRequest 
{   
    //use ApiResponse, 

    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules(): array;
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize(): bool;

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(["status"=>false,"data"=>null,"message"=>$this->extractValidationErrors($errors)], 412));
    }

    /**
     * Extract first validation error from 
     * error array
     *
     * @param array
     * @return string
     */
    public function extractValidationErrors(array $errors): string{
        $errorArrayKeys = array_keys($errors);

        return $errorMessage = $errors[$errorArrayKeys[0]][0];
    }
}