<?php namespace MXTranslator\Events;
use \MXTranslator\Repository as Repository;
use \stdClass as PhpObj;

class Event extends PhpObj {
    protected static $xapi_type = 'http://lrs.learninglocker.net/define/type/moodle/';

    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     */
    public function read(array $opts) {
        $version = str_replace(PHP_EOL, '', file_get_contents(__DIR__.'/../../VERSION'));
        $opts['info']->{'https://github.com/LearningLocker/Moodle-xAPI-Translator'} = $version;
        return [
            'user_id' => $opts['user']->id,
            'user_url' => $opts['user']->url,
            'user_name' => $opts['user']->username,
            'context_lang' => $opts['course']->lang,
            'context_platform' => 'Moodle',
            'context_ext' => $opts['event'],
            'context_ext_key' => 'http://lrs.learninglocker.net/define/extensions/moodle_logstore_standard_log',
            'context_info' => $opts['info'],
            'time' => date('c', $opts['event']['timecreated']),
            'app_url' => $opts['app']->url,
            'app_name' => $opts['app']->fullname ?: 'A Moodle course',
            'app_description' => $opts['app']->summary ?: 'A Moodle course',
            'app_type' => static::$xapi_type.$opts['app']->type,
            'app_ext' => $opts['app'],
            'app_ext_key' => 'http://lrs.learninglocker.net/define/extensions/moodle_course',
        ];
    }
}
