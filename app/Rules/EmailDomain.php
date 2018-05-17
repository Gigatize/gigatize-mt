<?php

namespace App\Rules;

use Hyn\Tenancy\Environment;
use Illuminate\Contracts\Validation\Rule;

class EmailDomain implements Rule
{

    protected $hostname;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $tenancy = app(Environment::class);
        $this->hostname = $tenancy->hostname();
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
        $domain_name = substr(strrchr($value, "@"), 1);
        return $this->hostname->email_domain == $domain_name;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must match the domain ' . $this->hostname->email_domain;
    }
}
