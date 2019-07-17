<?php

namespace Rupalipshinde\Template;

use RuntimeException;
use Illuminate\Support\Str;

class TemplateRepository {

    /**
     * Function to get all records
     */
    public function getAllTemplates() {
        $template = Template::template();
        return $template->all()->toArray();
    }

    /**
     * Get a client by the given ID.
     *
     * @param  int  $id
     * @return \Laravel\Passport\Client|null
     */
    public function find($id) {
        $template = Template::template();

        return $template->where($template->getKeyName(), $id)->first();
    }

    /**
     * Get a template instance for the given ID and user ID.
     *
     * @param  int  $templateId
     * @return rupalipshinde\templateWithLocalization\template;|null
     */
    public function findForTemplate($templateId) {
        $template = Template::template();

        return $template
                        ->where('id', $templateId)
                        ->first();
    }
    
     /**
     * Get a template instance for the given placeholder.
     *
     * @param  int  $placeholder
     * @return rupalipshinde\template\template;|null
     */
    public function findTemplateUsingEvent($event) {
        $template = Template::template();

        return $template
                        ->where('event', $event)
                        ->first();
    }

    /**
     * Store a new client.
     *
     * @param  int  $templateId
     * @param  string  $subject
     * @param  string  $description
     * @param  string  $language
     * @param  string  $placeholder
     * @param  string  $event
     * @param  string  $status
     * @return \rupalipshinde\template\templates
     */
    public function create($title, $subject, $description, $language, $placeholder, $event, $status) {
        $template = Template::Template()->forceFill([
            'title' => $title,
            'subject' => $subject,
            'description' => $description,
            'language' => $language,
            'placeholder' => $placeholder,
            'event' => $event,
            'status' => $status
        ]);

        $template->save();

        return $template;
    }

    /**
     * Update the given client.
     *
     * @param  int  $templateId
     * @param  string  $subject
     * @param  string  $description
     * @param  string  $language
     * @param  string  $placeholder
     * @param  string  $event
     * @param  string  $status
     * @return \rupalipshinde\template\templates
     */
    public function update(TemplateModel $template, $title, $subject, $description, $language, $placeholder, $event, $status) {
        $template->forceFill([
            'title' => $title,
            'subject' => $subject,
            'description' => $description,
            'language' => $language,
            'placeholder' => $placeholder,
            'event' => $event,
            'status' => $status
        ])->save();

        return $template;
    }

   
    /**
     * Delete the given template.
     *
     * @param \rupalipshinde\template\templates $template
     * @return void
     */
    public function delete(TemplateModel $template) {
//        $template->tokens()->update(['revoked' => true]);

        $template->forceFill(['revoked' => true])->save();
    }

}
