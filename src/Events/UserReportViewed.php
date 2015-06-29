<?php namespace MXTranslator\Events;

class UserReportViewed extends ModuleViewed {
    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override ModuleViewed
     */
    public function read(array $opts) {
        return array_merge(parent::read($opts), [
            'recipe' => 'module_viewed',
            'user_viewed' => $opts['context_ext']->relateduserid,
        ]);
    }
}