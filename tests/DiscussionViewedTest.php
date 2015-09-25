<?php namespace Tests;
use \MXTranslator\Events\DiscussionViewed as Event;

class DiscussionViewedTest extends EventTest {
    protected static $recipe_name = 'discussion_viewed';

    /**
     * Sets up the tests.
     * @override TestCase
     */
    public function setup() {
        $this->event = new Event($this->repo);
    }

    protected function constructInput() {
        return array_merge(parent::constructInput(), [
            'discussion' => $this->constructDiscussion(),
            'module' => $this->constructModule(),
        ]);
    }

    private function constructModule() {
        return (object) [
            'url' => 'http://www.example.com/module_url',
            'name' => 'Test module_name',
            'intro' => 'Test module_intro',
        ];
    }
    
    private function constructDiscussion() {
        return (object) [
            'url' => 'http://www.example.com/discussion_url',
            'name' => 'Test discussion_name',
            'description' => 'Test discussion_intro',
            'ext' => 'discussion_ext',
            'ext_key' => 'http://lrs.learninglocker.net/define/extensions/moodle_discussion',
        ];
    }

    protected function assertOutput($input, $output) {
        parent::assertOutput($input, $output);
        $this->assertDiscussion($input, $output);
    }

    protected function assertModule($input, $output, $type) {
        $ext_key = 'http://lrs.learninglocker.net/define/extensions/moodle_discussion';
        $this->assertEquals($input->url, $output[$type.'_url']);
        $this->assertEquals($input->name, $output[$type.'_name']);
        $this->assertEquals($input->description, $output[$type.'_description']);
        $this->assertEquals($input, $output[$type.'_ext']);
        $this->assertEquals($ext_key, $output[$type.'_ext_key']);
    }
}
