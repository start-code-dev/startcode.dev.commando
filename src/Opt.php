<?php

namespace Startcode\Commando;

class Opt
{

    private array $options;
    private array $long;
    private array $short;
    private ?array $optValues;
    private ?Value $value;

    public function __construct()
    {
        $this->options   = [];
        $this->long      = [];
        $this->short     = [];
    }


    public function addOption(Option $option) : self
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue(string $optionName)
    {
        $this->executeGetOpt();
        return $this->value->getValue($optionName);
    }

    public function hasValue(string $optionName) : bool
    {
        $this->executeGetOpt();
        return $this->value->hasValue($optionName);
    }

    private function addLong(string $long) : self
    {
        if (!empty($long)) {
            $this->long[$long] = $long.':';
        }
        return $this;
    }

    private function addShort(string $short) : self
    {
        if (!empty($short)) {
            $this->short[$short] = $short.':';
        }
        return $this;
    }

    private function analizeOptions() : self
    {
        foreach($this->options as $option) {
            $this
                ->addLong($option->getLong())
                ->addShort($option->getShort());
        }
        return $this;
    }

    private function getLongFormatted() : array
    {
        return array_values($this->long);
    }

    private function getShortFormatted() : string
    {
        return implode('', $this->short);
    }

    private function hasOptionsAndValues() : bool
    {
        return count($this->options) > 0 && $this->optValues !== null;
    }

    private function executeGetOpt() : void
    {
        if (!$this->hasOptionsAndValues()) {

            $this->analizeOptions();

            $this->optValues = getopt($this->getShortFormatted(), $this->getLongFormatted());

            $this->value     = new Value($this->options, $this->optValues);
            $this->value->fill();
        }
    }
}
