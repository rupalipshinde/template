<?php

namespace Rupalipshinde\Template;
//
use Illuminate\Support\Facades\Route;

class Template
{
    public function templateUsingEvent($event) {
        return (new Http\Controllers\TemplateController)->findTemplateUsingEvent($event);
    }
}
