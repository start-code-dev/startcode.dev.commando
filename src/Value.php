<?php

namespace Startcode\Commando;

class Value
{

    private array $options;
    private array $optionValues;
    private array $values;

    public function __construct(array $options, array $optionValues)
    {
        $this->options      = $options;
        $this->optionValues = $optionValues;
        $this->values       = [];
    }

    public function fill() : void
    {
        foreach ($this->options as $option) {
            $this->values[$option->getLong()]  = $option->getValue($this->optionValues);
            $this->values[$option->getShort()] = $option->getValue($this->optionValues);
        }
    }

    /**
     * @return mixed
     */
    public function getValue(string $optionName)
    {
        return $this->hasValue($optionName)
            ? $this->values[$optionName]
            : null;
    }

    public function hasValue($optionName) : bool
    {
        return isset($this->values[$optionName]);
    }
}
