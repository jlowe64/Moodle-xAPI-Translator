<?php namespace MXTranslator\Events;

class EnrolmentCreated extends CourseViewed {
    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override CourseViewed
     */
    public function read(array $opts) {
        return array_merge(parent::read($opts), [
            'recipe' => 'enrolment_created',
        ]);
    }
}