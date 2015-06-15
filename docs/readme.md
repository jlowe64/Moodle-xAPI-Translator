## Installation and Upgrading
You'll need to install [Composer](https://getcomposer.org/) first.

- Install with `composer require learninglocker/moodle-log-expander`.
- Update with `composer update learninglocker/moodle-log-expander`.


## Supported Events
Mapping for moodle event names to expander event classes can be found in the [Controller](../src/Controller.php).

Moodle Event | Translator Event
--- | ---
\core\event\course_viewed | [CourseViewed](../src/events/CourseViewed.php)
\mod_page\event\course_module_viewed | [ModuleViewed](../src/events/ModuleViewed.php)
\mod_quiz\event\course_module_viewed | [ModuleViewed](../src/events/ModuleViewed.php)
\mod_url\event\course_module_viewed | [ModuleViewed](../src/events/ModuleViewed.php)
\mod_folder\event\course_module_viewed | [ModuleViewed](../src/events/ModuleViewed.php)
\mod_book\event\course_module_viewed | [ModuleViewed](../src/events/ModuleViewed.php)
\mod_quiz\event\attempt_preview_started | [AttemptStarted](../src/events/AttemptStarted.php)
\mod_quiz\event\attempt_reviewed | [AttemptReviewed](../src/events/AttemptReviewed.php)
\core\event\user_loggedin | [UserLoggedin](../src/events/UserLoggedin.php)
\core\event\user_loggedout | [UserLoggedout](../src/events/UserLoggedout.php)
\mod_assign\event\submission_graded | [AssignmentGraded](../src/events/AssignmentGraded.php)
\mod_assign\event\assessable_submitted | [AssignmentSubmitted](../src/events/AssignmentSubmitted.php)