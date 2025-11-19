<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckCurrentPassword implements Rule
{
    public $passwordHash;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($passwordHash = NULL)
    {
        if(!empty($passwordHash)){
            $this->passwordHash = $passwordHash;
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
       return \Hash::check($value , $this->passwordHash);
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Current password doesnt matched.';
    }
}
