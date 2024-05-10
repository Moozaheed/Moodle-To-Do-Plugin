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
 * Version metadata for the local_todolist plugin.
 *
 * @package   local_todolist
 * @copyright 2024, Moozaheed
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function local_todolist_display() {
    global $DB, $OUTPUT;
    $alltasks = $DB->get_records('local_todolist');

    $templatecontext = (object) [
        'tasks' => array_values($alltasks),
        'editurl' => new moodle_url('/local/todolist/edit.php'),
    ];

    echo $OUTPUT->render_from_template('local_todolist/manage', $templatecontext);
}

function local_todolist_init_form(int $id = null): edit_form {
    global $DB;

    $actionurl = new moodle_url('/local/todolist/edit.php');

    if ($id) {
        $record = $DB->get_record('local_todolist', array('id' => $id));
        $mform = new edit_form($actionurl, $record);
    } else {
        $mform = new edit_form($actionurl);
    }

    return $mform;
}

function local_todolist_edit_form(edit_form $mform, int $id = null) {
    global $DB;

    if ($mform->is_cancelled()) {
        redirect(new moodle_url('/local/todolist/manage.php'));
    } else if ($fromform = $mform->get_data()) {
        $taskdata = new stdClass();
        $taskdata->task_title = $fromform->task_title;
        $taskdata->task_description = $fromform->task_description;

        if ($fromform->id) {
            $taskdata->id = $fromform->id;
            $DB->update_record('local_todolist', $taskdata);
            redirect(new moodle_url('/local/todolist/manage.php'));
        } else {
            $DB->insert_record('local_todolist', $taskdata);
            redirect(new moodle_url('/local/todolist/manage.php'));
        }
    }
}

function local_todolist_delete_task($id) {
    global $DB;

    try {
        $DB->delete_records('local_todolist', array('id' => $id));
    } catch (Exception $exception) {
        throw new moodle_exception($exception);
    }
}
