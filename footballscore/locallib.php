<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Plugin's library functions.
 *
 * @package    local_footballscore
 * @copyright  2021 Shadman Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * This function prints all the score from the db table.
 *
 * @return void
 * @throws dml_exception
 */
function local_footballscore_display_scores() {
    global $DB, $OUTPUT;
    $goalrecords = $DB->get_records('local_footballscore');

    // Data to be passed in the manage template.
    $templatecontext = (object) [
        'texttodisplay' => array_values($goalrecords),
        'editurl' => new moodle_url('/local/footballscore/edit.php'),
    ];

    echo $OUTPUT->render_from_template('local_footballscore/manage', $templatecontext);
}

/**
 * This function init the edit_form class and return the object.
 *
 * @param int|null $id
 * @return edit_form
 * @throws dml_exception
 */
function local_footballscore_init_form(int $id = null): edit_form {
    global $DB;

    $actionurl = new moodle_url('/local/footballscore/edit.php');

    if ($id) {
        $score = $DB->get_record('local_footballscore', array('id' => $id));
        $mform = new edit_form($actionurl, $score);
    } else {
        $mform = new edit_form($actionurl);
    }
    return $mform;
}

/**
 * This function create or edit a single record.
 *
 * @param int|null $id
 * @param edit_form $mform
 * @return void
 * @throws moodle_exception
 */
function local_footballscore_edit_score(edit_form $mform, int $id = null) {
    global $DB;
    if ($mform->is_cancelled()) {
        //Back to manage.php
        redirect(new moodle_url('/local/footballscore/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        // Handing the form data.
        $recordstoinsert = new stdClass();
        $recordstoinsert->team1 = $fromform->team1;
        $recordstoinsert->team2 = $fromform->team2;
        $recordstoinsert->goal1 = $fromform->goal1;
        $recordstoinsert->goal2 = $fromform->goal2;
        if ($fromform->id) {
            // Update the record.
            $recordstoinsert->id = $fromform->id;
            $DB->update_record('local_footballscore', $recordstoinsert);
            // Go back to manage page.
            redirect(new moodle_url('/local/footballscore/manage.php'), get_string('updatethanks', 'local_footballscore'));

        } else {
            // Insert the record.
            $DB->insert_record('local_footballscore', $recordstoinsert);
            // Go back to manage page.
            redirect(new moodle_url('/local/footballscore/manage.php'), get_string('insertthanks', 'local_footballscore'));
        }
    }
}

/**
 * This function delete a single record.
 *
 * @param int|null $id
 * @return void
 * @throws moodle_exception
 */
function local_footballscore_delete_score($id) {
    global $DB;
    try {
        $DB->delete_records('local_footballscore', array('id' => $id));
    } catch (Exception $exception) {
        throw new moodle_exception($exception);
    }
}