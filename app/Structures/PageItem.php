<?php

namespace App\Structures;

class PageItem
{
    /** @var int */
    public $toPage;

    /** @var bool */
    public $disabled;

    /** @var string */
    public $text;

    public function __construct(string $text, int $toPage, bool $disabled)
    {
        $this->text = $text;
        $this->toPage = $toPage;
        $this->disabled = $disabled;
    }
}
