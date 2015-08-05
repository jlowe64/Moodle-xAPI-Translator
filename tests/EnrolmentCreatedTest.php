<?php namespace Tests;
use \MXTranslator\Events\EnrolmentCreated as Event;

class EnrolmentCreatedTest extends EventTest {
    protected static $recipe_name = 'enrolment_created';
    
    /**
     * Sets up the tests.
     * @override TestCase
     */
    public function setup() {
        $this->event = new Event($this->repo);
    }
}
