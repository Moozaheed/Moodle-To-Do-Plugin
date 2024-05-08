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


 require_once(__DIR__ . '/../../config.php');
 require_once('./locallib.php');
 require_once($CFG->dirroot . '/local/todolist/classes/form/edit_form.php');
 
 try {
     require_login();
 } catch (Exception $exception) {
     print_r($exception);
     exit; // Exit gracefully if login fails
 }
 
 // Get the 'id' parameter from the URL
 $id = optional_param('id', 0, PARAM_INT);
 
 // Set up the page
 $PAGE->set_url(new moodle_url('/local/todolist/edit.php', array('id' => $id)));
 $PAGE->set_context(\context_system::instance());
 $PAGE->set_title('Add or Edit Task');
 
 // Initialize the form
 $mform = local_todolist_init_form($id);
 
 // Process form submission
 local_todolist_edit_form($mform, $id);
 
 // Output the page header
 echo $OUTPUT->header();
 
 // Display the page heading
 echo $OUTPUT->heading("Create or Edit Task");
 
 // Display the form
 $mform->display();
 
 // Output the page footer
 echo $OUTPUT->footer();
 
 