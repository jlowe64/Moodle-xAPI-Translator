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
            'instructor_id' => $opts['instructor']->id,
            'instructor_url' => $opts['instructor']->url,
            'instructor_name' => $opts['instructor']->username,
        ]);
    }
}