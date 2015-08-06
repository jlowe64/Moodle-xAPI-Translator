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
            'user_id' => $opts['relateduser']->id,
            'user_url' => $opts['relateduser']->url,
            'user_name' => $opts['relateduser']->username,
            'instructor_id' => $opts['user']->id,
            'instructor_url' => $opts['user']->url,
            'instructor_name' => $opts['user']->username,
            'course_url' => $opts['course']->url,
            'course_name' => $opts['course']->fullname ?: 'A Moodle course',
            'course_description' => $opts['course']->summary ?: 'A Moodle course',
            'course_type' => static::$xapi_type.$opts['course']->type,
            'course_ext' => $opts['course'],
            'course_ext_key' => 'http://lrs.learninglocker.net/define/extensions/moodle_course',
        ]);
    }
}