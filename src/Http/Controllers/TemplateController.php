<?php

namespace Rupalipshinde\Template\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Rupalipshinde\Template\TemplateModel;
use Rupalipshinde\Template\Http\Resources\Template as TemplateResource;
use Rupalipshinde\Template\Http\Requests\StoreTemplateRequest as StoreTemplateRequest;
use Rupalipshinde\Template\Http\Requests\UpdateTemplateRequest as UpdateTemplateRequest;
use Illuminate\Foundation\Application;

class TemplateController {

    /**
     * The template repository instance.
     *
     * @var Rupalipshinde\Template\TemplateRepository;
     */
    protected $templates;

    /**
     * The validation factory implementation.
     *
     * @var \Illuminate\Contracts\Validation\Factory
     */
    protected $validation;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    /**
     * Get all of the templates for the authenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function forTemplate(Request $request) {
        $appLang = $this->app->config->get('app.locale') ? $this->app->config->get('app.locale') : $this->app->config->get('app.fallback_locale');
        return TemplateResource::collection(TemplateModel::search($request->filter)
                                ->where('language', $appLang)
                                ->orderBy('created_at', 'desc')
                                ->paginate($request->size, ['*'], 'pageNumber'));
    }

    /**
     * Get selected template .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function forSelectedTemplate($templateId) {
        return new TemplateResource(TemplateModel::findOrFail($templateId));
    }

    /**
     * Get template using event .
     *
     * @param  $event
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findTemplateUsingEvent($event) {
        $appLang = $this->app->config->get('app.locale') ? $this->app->config->get('app.locale') : $this->app->config->get('app.fallback_locale');
        return new TemplateResource(TemplateModel::where('event', $event)
                        ->where('language', $appLang)
                        ->first());
    }
    
     /**
     * Get template using language .
     *
     * @param  $event
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findTemplateUsingLanguage($language,$event) {
        return new TemplateResource(TemplateModel::where('language', $language)
                        ->where('event', $event)
                        ->first());
    }

    /**
     * Store a new template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \rupalipshinde\template\Template
     */
    public function store(StoreTemplateRequest $request) {
        $template = new TemplateModel();
        $template->title = $request->title;
        $template->subject = $request->subject;
        $template->description = $request->description;
        $template->language = $request->language;
        $template->placeholder = $request->placeholder;
        $template->event = $request->event;
        $template->status = $request->status;
        $template->save();
        return response(
                array(
            "message" => __('Created', array('entity' => trans('common.template'))),
            "status" => true,
                ), 201);
    }

    /**
     * Update the given template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $templateId
     * @return \Illuminate\Http\Response|\rupalipshinde\template\Template
     */
    public function update(UpdateTemplateRequest $request, $templateId) {
        $template = TemplateModel::findOrFail($templateId);

        if (!$template) {
            return new Response('', 404);
        }

        $template->title = $request->title;
        $template->subject = $request->subject;
        $template->description = $request->description;
        $template->language = $request->language;
//        $template->placeholder = $request->placeholder;
//        $template->event = $request->event;
//        $template->status = $request->status;
        $template->save();
        return response(
                array(
            "message" => __('crud.updated_msg', array('entity' => trans('common.translation'))),
            "status" => true,
                ), 200);
    }

    /**
     * Delete the given template.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $templateId
     * @return \Illuminate\Http\Response
     */
    public function destroy($templateId) {
//        $template = $this->templates->findForTemplate($templateId);
//
//        if (!$template) {
//            return new Response('', 404);
//        }
//
//        $this->templates->delete($template);
//
//        return new Response('', Response::HTTP_NO_CONTENT);
    }

}
