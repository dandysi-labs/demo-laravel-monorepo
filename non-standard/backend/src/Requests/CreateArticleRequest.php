<?php

namespace Backend\Requests;

use Common\Models\Article;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'headline' => 'required|string|max:' . Article::MAX_LENGTH_HEADLINE,
            'content' => 'required|string|max:' . Article::MAX_LENGTH_CONTENT,
            'category' => ['required','string', Rule::in(Article::CATEGORIES)],
            'author' => ['required', 'string', Rule::in(Article::AUTHORS)],
        ];
    }
}
