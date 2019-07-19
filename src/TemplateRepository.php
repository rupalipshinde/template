<?php

namespace Rupalipshinde\Template;

use RuntimeException;
use Illuminate\Support\Str;

class TemplateRepository {

    
     /**
     * Get a template instance for the given placeholder.
     *
     * @param  int  $placeholder
     * @return rupalipshinde\template\template;|null
     */
    public function templateUsingEvent($event) {
        $template = Template::template();

        return $template
                        ->where('event', $event)
                        ->first();
    }

}
