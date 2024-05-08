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


function local_todolist_display(){

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

    // var_dump($id);
    // die;

    $actionurl = new moodle_url('/local/todolist/edit.php');

    if ($id) {
        // Fetch the record based on the id
        $record = $DB->get_record('local_todolist', array('id' => $id));
        
        // var_dump($record);
        // die();
        // Initialize the form with the fetched record
        $mform = new edit_form($actionurl, $record);

    } else {
        // Initialize the form without any pre-existing record
        $mform = new edit_form($actionurl);
    }

    return $mform;
}

function local_todolist_edit_form(edit_form $mform,int $id=null) {
    global $DB;
    // var_dump($mform->get_data()->id);
    // die;
    if ($mform->is_cancelled()) {
        // Back to manage.php
        redirect(new moodle_url('/local/todolist/manage.php'));
    } else if ($fromform = $mform->get_data()) {
    //     var_dump($fromform->task_title);
    // die;
        // Handling the form data.
        $taskdata = new stdClass();
        $taskdata->task_title = $fromform->task_title;
        $taskdata->task_description = $fromform->task_description;

        // var_dump($mform->data);
        // die;

        if ($fromform->id) {
            // Update the record.
            $taskdata->id = $fromform->id;
            $DB->update_record('local_todolist', $taskdata);
            redirect(new moodle_url('/local/todolist/manage.php'));
        } else {
            // Insert the record.
            $DB->insert_record('local_todolist', $taskdata);
            redirect(new moodle_url('/local/todolist/manage.php'));
        }

        // Display success message and redirect
        // You might want to display a success message here before redirecting
        // redirect(new moodle_url('/local/todolist/manage.php'));
    }
}
