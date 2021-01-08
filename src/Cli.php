<?php

namespace Startcode\Commando;

class Cli
{

    private Opt $opt;

    private ?string $version;

    public function __construct()
    {
        $this->checkIfRunningInCli();
        $this->opt = new Opt();
    }

    public function has(string $optionName) : bool
    {
        return $this->opt->hasValue($optionName);
    }

    public function option() : Option
    {
        $option = new Option($this);
        $this->opt->addOption($option);
        return $option;
    }

    public function value(string $optionName) : string
    {
        return $this->opt->getValue($optionName);
    }

    public function version(string $version) : self
    {
        $this->version = $version;
        return $this;
    }

    private function checkIfRunningInCli() : void
    {
        if (PHP_SAPI !== 'cli') {
            echo 'Warning: Composer should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL;
        }
    }
}
