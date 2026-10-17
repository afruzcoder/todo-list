<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', Rule::in(['done', 'doing', 'not started'])],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'startTime' => ['required', 'date'],
            'endTime' => ['required', 'date', 'after_or_equal:startTime'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'endTime.after_or_equal' => 'The end time must be a date after or equal to the start time.',
        ];
    }
}
