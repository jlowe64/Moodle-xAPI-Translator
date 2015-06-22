<?php namespace MXTranslator\Events;

class AttemptAbandoned extends AttemptStarted {
    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override AttemtAbandoned
     */
    public function read(array $opts) {
        return array_merge(parent::read($opts), [
            'recipe' => 'attempt_completed',
            'attempt_duration' => $duration,
            'attempt_abandoned' => $opts['attempt']->state === 'abandoned',
        ]);
    }
}