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


// moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit_form extends moodleform {

    protected $data;

    /**
     * Constructor.
     */
    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        // echo "I am at class";
        // var_dump($data);
        // die;
        parent::__construct($actionurl);
    }

    
    // Add elements to form.
    public function definition() {
        global $CFG;
        $mform = $this->_form;

        $mform->addElement('hidden', 'id', 'Id');
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->data->id ?? "");

        // Add element for Task Title
        $mform->addElement('text', 'task_title', "Task Title");
        $mform->setType('task_title', PARAM_TEXT);
        $mform->setDefault('task_title', $this->data->task_title ?? ""); // You can set a default value if needed


        // Add element for Task Description
        $mform->addElement('textarea', 'task_description', "Task Description");
        $mform->setType('task_description', PARAM_TEXT);
        $mform->setDefault('task_description', $this->data->task_description ?? ""); // You can set a default value if needed

        
        // Set validation rules
        $mform->addRule('task_title', '', 'required', null, 'client');
        $mform->addRule('task_description', '', 'required', null, 'client');

        $this->add_action_buttons();
    }
    
}
