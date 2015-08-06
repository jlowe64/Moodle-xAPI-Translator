<?php namespace MXTranslator\Events;

class EnrolmentCreated extends Event {
    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override Event
     */
    public function read(array $opts) {
        return array_merge(parent::read($opts), [
            'recipe' => 'enrolment_created',
            'user_id' => $opts['relateduser']->id,
            'user_url' => $opts['relateduser']->url,
            'user_name' => $opts['relateduser']->username,
            'instructor_id' => $opts['user']->id,
            'instructor_url' => $opts['user']->url,
            'instructor_name' => $opts['user']->username,
        ]);
    }
}