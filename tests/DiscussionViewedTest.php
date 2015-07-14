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
            'discussion_url' => 'http://www.example.com/module_url',
            'discussion_name' => 'Test discussion_name',
            'discussion_description' => 'Test discussion_intro',
            'discussion_ext' => 'discussion_ext',
            'discussion_ext_key' => 'http://lrs.learninglocker.net/define/extensions/moodle_discussion',
        ];
    }

    protected function assertOutput($input, $output) {
        parent::assertOutput($input, $output);
        $this->assertModule($input['module'], $output, 'discussion');
    }

    protected function assertModule($input, $output, $type) {
        $ext_key = 'http://lrs.learninglocker.net/define/extensions/moodle_discussion';
        $this->assertEquals($input->url, $output[$type.'_url']);
        $this->assertEquals($input->name, $output[$type.'_name']);
        $this->assertEquals($input->intro, $output[$type.'_description']);
        $this->assertEquals($input, $output[$type.'_ext']);
        $this->assertEquals($ext_key, $output[$type.'_ext_key']);
    }
}
