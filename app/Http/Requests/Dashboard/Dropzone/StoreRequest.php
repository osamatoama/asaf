<?php

namespace App\Http\Requests\Dashboard\Dropzone;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Dimensions;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => $this->getRules(),
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'الملف مطلوب',
            'file.image'    => 'الملف يجب أن يكون صورة',
            'file.mimes'    => 'نوع الملف يجب أن يكون ( ' . $this->get('mimes') . ' )',
        ];
    }

    protected function getRules(): Collection
    {
        $rules = collect(['required']);
        if ($this->filled('size')) {
            $rules->push('max:' . $this->get('size') * 1024);
        }
        if ($this->filled('max')) {
            $rules->push('max:' . $this->get('max') * 1024);
        }
        if ($this->filled('mimes')) {
            $rules->push('mimes:' . $this->get('mimes'));
        }
        if ($this->hasDimensions()) {
             $rules->push('image'/*, $this->getDimensions()*/);
        } else {
            $rules->push('file');
        }

        return $rules;
    }

    protected function hasDimensions(): bool
    {
        return $this->anyFilled(['min_width', 'max_width', 'min_height', 'max_height', 'width', 'height', 'ratio']);
    }

    protected function getDimensions(): Dimensions
    {
        $dimensions = Rule::dimensions();
        if ($this->filled('min_width')) {
            $dimensions->minWidth($this->get('min_width'));
        }
        if ($this->filled('max_width')) {
            $dimensions->maxWidth($this->get('max_width'));
        }
        if ($this->filled('min_height')) {
            $dimensions->minHeight($this->get('min_height'));
        }
        if ($this->filled('max_height')) {
            $dimensions->minHeight($this->get('max_height'));
        }
        if ($this->filled('width')) {
            $dimensions->width($this->get('width'));
        }
        if ($this->filled('height')) {
            $dimensions->height($this->get('height'));
        }
        if ($this->filled('ratio')) {
            $dimensions->ratio($this->get('ratio'));
        }

        return $dimensions;
    }

    private function dimensionsValidationMessage(): string {
        if ($this->filled('width') && $this->filled('height')) {
            return 'أبعاد الصورة يجب أن تكون ' . $this->get('width') . ' في ' . $this->get('height');
        }

        if($this->filled('min_width') && $this->filled('min_height')) {
            $message = 'أقل أبعاد للصورة ' . $this->get('min_width') . ' في ' . $this->get('min_height');
        } elseif ($this->filled('max_width') && $this->filled('max_height')) {
            $message = 'أقصى أبعاد للصورة ' . $this->get('max_width') . ' في ' . $this->get('max_height');
        } else {
            $message = 'أبعاد الصورة غير صالحة';
        }

        if ($this->filled('ratio')) {
            $ratioMessage = 'نسبة العرض إلى الطول في الصورة يجب أن تكون ' . $this->get('ratio');
            $message .= ' و ' . $ratioMessage;
        }

        return $message;
    }
}
