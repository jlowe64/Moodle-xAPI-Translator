<?php namespace MXTranslator\Tests;
use \PHPUnit_Framework_TestCase as PhpUnitTestCase;
use \MXTranslator\Events\Event as Event;

abstract class EventTest extends PhpUnitTestCase {
    protected static $xapi_type = 'http://lrs.learninglocker.net/define/type/moodle/';
    protected static $recipe_name;

    /**
     * Sets up the tests.
     * @override PhpUnitTestCase
     */
    public function setup() {
        $this->event = new Event();
    }

    /**
     * Tests the read method of the Event.
     */
    public function testRead() {
        $input = $this->constructInput();
        $output = $this->event->read($input);
        $this->assertOutput($input, $output);
    }

    protected function constructInput() {
        return [
            'user' => $this->constructUser(),
            'relateduser' => $this->constructUser(),
            'course' => $this->constructCourse(),
            'app' => $this->constructCourse(),
            'event' => $this->constructEvent('\core\event\course_viewed'),
            'info' => $this->constructInfo(),
        ];
    }

    protected function constructInfo() {
        return (object) [
            'https://moodle.org/' => '1.0.0',
            'https://github.com/LearningLocker/Moodle-Log-Expander' => '1.0.0',
        ];
    }

    protected function constructUser() {
        return (object) [
            'id' => 1,
            'url' => 'http://www.example.com/user_url',
            'username' => 'Test user_name',
        ];
    }

    private function constructEvent($event_name) {
        return [
            'eventname' => $event_name,
            'timecreated' => 1433946701,
        ];
    }

    protected function constructCourse() {
        return (object) [
            'url' => 'http://www.example.com/course_url',
            'fullname' => 'Test course_fullname',
            'summary' => 'Test course_summary',
            'lang' => 'en',
            'type' => 'moodle_course',
        ];
    }

    protected function assertOutput($input, $output) {
        $this->assertApp($input['app'], $output, 'app');
        $this->assertEvent($input['event'], $output);
        $this->assertEquals(static::$recipe_name, $output['recipe']);
        $this->assertInfo($input['info'], $output['context_info']);
    }

    protected function assertUser($input, $output, $type) {
        $this->assertEquals($input->id, $output[$type.'_id']);
        $this->assertEquals($input->url, $output[$type.'_url']);
        $this->assertEquals($input->username, $output[$type.'_name']);
    }

    protected function assertCourse($input, $output, $type) {
        $ext_key = 'http://lrs.learninglocker.net/define/extensions/moodle_course';
        $this->assertEquals($input->lang, $output['context_lang']);
        $this->assertEquals($input->url, $output[$type.'_url']);
        $this->assertEquals($input->fullname, $output[$type.'_name']);
        $this->assertEquals($input->summary, $output[$type.'_description']);
        $this->assertEquals(static::$xapi_type.$input->type, $output[$type.'_type']);
        $this->assertEquals($input, $output[$type.'_ext']);
        $this->assertEquals($ext_key, $output[$type.'_ext_key']);
    }
    
    protected function assertApp($input, $output, $type) {
        $ext_key = 'http://lrs.learninglocker.net/define/extensions/moodle_course';
        $app_type = 'http://id.tincanapi.com/activitytype/site';
        $this->assertEquals($input->lang, $output['context_lang']);
        $this->assertEquals($input->url, $output[$type.'_url']);
        $this->assertEquals($input->fullname, $output[$type.'_name']);
        $this->assertEquals($input->summary, $output[$type.'_description']);
        $this->assertEquals($app_type, $output[$type.'_type']);
        $this->assertEquals($input, $output[$type.'_ext']);
        $this->assertEquals($ext_key, $output[$type.'_ext_key']);
    }

    private function assertEvent($input, $output) {
        $ext_key = 'http://lrs.learninglocker.net/define/extensions/moodle_logstore_standard_log';
        $this->assertEquals('Moodle', $output['context_platform']);
        $this->assertEquals($input, $output['context_ext']);
        $this->assertEquals($ext_key, $output['context_ext_key']);
        $this->assertEquals(date('c', $input['timecreated']), $output['time']);
    }

    private function assertInfo($input, $output) {
        $version = str_replace("\n", "", str_replace("\r", "", file_get_contents(__DIR__.'/../VERSION')));
        $this->assertEquals(
            $input->{'https://moodle.org/'},
            $output->{'https://moodle.org/'}
        );
        $this->assertEquals(
            $input->{'https://github.com/LearningLocker/Moodle-Log-Expander'},
            $output->{'https://github.com/LearningLocker/Moodle-Log-Expander'}
        );
        $this->assertEquals(
            $version,
            $output->{'https://github.com/LearningLocker/Moodle-xAPI-Translator'}
        );
    }
}
