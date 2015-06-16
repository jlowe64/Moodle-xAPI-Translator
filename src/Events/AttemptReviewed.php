<?php namespace MXTranslator\Events;

class AttemptReviewed extends AttemptStarted {
    /**
     * Reads data for an event.
     * @param [String => Mixed] $opts
     * @return [String => Mixed]
     * @override AttemtStarted
     */
    public function read(array $opts) {
        return array_merge(parent::read($opts), [
            'recipe' => 'attempt_completed',
            'attempt_result' => (float) ($opts['attempt']->sumgrades ?: 0),
            'attempt_completed' => $opts['attempt']->state === 'finished',
            'attempt_duration' => $duration,
        ]);
    }
}