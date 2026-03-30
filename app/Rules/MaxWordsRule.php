<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordsRule implements Rule
{
    public $max_words;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($max_words = NULL)
    {
        if(!empty($max_words)){
            $this->max_words = $max_words;
        }
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return str_word_count(strip_tags($value)) <= $this->max_words;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute cannot be longer than '.$this->max_words.' words.';
    }
}
