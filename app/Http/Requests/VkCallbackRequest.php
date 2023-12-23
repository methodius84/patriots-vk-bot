<?php

namespace App\Http\Requests;

use App\DTO\VkCallbackDto\VkDtoInterface;
use App\DTO\VkCallbackDto\VkNewEventDto;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VkCallbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->post()['secret'] === config('services.vk.token');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function data(): VkDtoInterface
    {
        return VkNewEventDto::createFromRequest($this->post());
    }
}
