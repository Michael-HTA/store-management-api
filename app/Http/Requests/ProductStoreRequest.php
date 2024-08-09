<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'manufacturing_date' => 'required|date',
            'expiry_date' =>'required|date|after:manufacturing_date',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'model_form_id' => 'required|exists:model_forms,id',
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => 0,
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'meta' => [
                    'method' => $this->getMethod(),
                    'endpoint' => $this->path(),
                ],
                'data' => [
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                ],
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
