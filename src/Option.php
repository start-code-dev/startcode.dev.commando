<?php

namespace Startcode\Commando;

class Option
{

    private Cli $cli;

    private ?string $desc;

    private ?string $long;

    private ?string $short;


    public function __construct(Cli $cli)
    {
        $this->cli = $cli;
    }

    public function desc(string $desc) : Cli
    {
        $this->desc = $desc;
        return $this->cli;
    }

    public function getLong() : string
    {
        return $this->long;
    }

    public function getShort() : string
    {
        return $this->short;
    }

    public function getValue(array $optionValues) : ?string
    {
        if (isset($optionValues[$this->short])) {
            return $optionValues[$this->short];
        }
        if (isset($optionValues[$this->long])) {
            return $optionValues[$this->long];
        }
        return null;
    }

    public function long(string $long) : self
    {
        $this->long = $long;
        return $this;
    }

    public function short(string $short) : self
    {
        $this->short = $short;
        return $this;
    }
}
