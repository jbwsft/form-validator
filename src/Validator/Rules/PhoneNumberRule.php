<?php
namespace FormValidator\Validator\Rules;

class PhoneNumberRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        $phoneNormalized = $this->normalizePhoneNumber($value);

        return !$this->hasForbiddenSymbols($phoneNormalized) && $this->hasCorrectLength($phoneNormalized);
    }

    public function normalizePhoneNumber($number)
    {
        return preg_replace("/(\(|\)|\+|-|\s)/", "", $number);
    }

    public function hasForbiddenSymbols($number)
    {
        preg_match('/\D/', $number, $forbiddenSymbolsArray);

        if ($forbiddenSymbolsArray === [])
            return false;

        return true;
    }

    public function hasCorrectLength($number)
    {
        $phoneLength = strlen($number);

        if ($phoneLength < 7 || $phoneLength > 15)
            return false;

        return true;
    }
}