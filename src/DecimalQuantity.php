<?php

declare(strict_types=1);

namespace OsiemSiedem\Translation;

class DecimalQuantity
{
    /**
     * The value of the object.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Create a new decimal quantity.
     *
     * @param  mixed  $value
     * @return void
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Get the value for a given operand.
     *
     * @see http://unicode.org/reports/tr35/tr35-numbers.html#Operands
     *
     * @param  string  $operand
     * @return float|int
     */
    public function getPluralOperand(string $operand)
    {
        switch (strtolower($operand)) {
            case 'i':
                return (int) abs($this->value);
            case 'v':
                return strlen($this->getFractionalDigits());
            case 'w':
                return strlen($this->getFractionalDigits(true));
            case 'f':
                return (int) $this->getFractionalDigits();
            case 't':
                return (int) $this->getFractionalDigits(true);
            default:
                return (float) abs($this->value);
        }
    }

    /**
     * Get the fractional digits of the number.
     *
     * @param  bool  $trim
     * @return string
     */
    protected function getFractionalDigits(bool $trim = false): string
    {
        if (is_float($this->value) && fmod($this->value, 1) === 0.0) {
            return $trim ? '' : '0';
        }

        $result = explode('.', (string) $this->value)[1] ?? null;

        if (is_null($result)) {
            return '';
        }

        if ($trim) {
            $result = rtrim($result, '0');
        }

        return $result === '' ? '' : $result;
    }
}
