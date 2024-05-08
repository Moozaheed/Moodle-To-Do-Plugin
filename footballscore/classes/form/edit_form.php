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
 * Edit form class.
 *
 * @package    local_footballscore
 * @copyright  2021 Shadman Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("$CFG->libdir/formslib.php");

class edit_form extends moodleform {

    protected $data;

    /**
     * Constructor.
     */
    public function __construct($actionurl, $data = null) {
        $this->data = $data;
        parent::__construct($actionurl);
    }

    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'id', get_string('id', 'local_footballscore'));
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->data->id ?? "");

        $mform->addElement('text', 'team1', get_string('team1', 'local_footballscore'));
        $mform->setType('team1', PARAM_TEXT);
        $mform->setDefault('team1', $this->data->team1 ?? "");

        $mform->addElement('text', 'goal1', get_string('goal1', 'local_footballscore'));
        $mform->setType('goal1', PARAM_INT);
        $mform->setDefault('goal1', $this->data->goal1 ?? "");

        $mform->addElement('text', 'team2', get_string('team2', 'local_footballscore'));
        $mform->setType('team2', PARAM_TEXT);
        $mform->setDefault('team2', $this->data->team2 ?? "");

        $mform->addElement('text', 'goal2', get_string('goal2', 'local_footballscore'));
        $mform->setType('goal2', PARAM_INT);
        $mform->setDefault('goal2', $this->data->goal2 ?? "");

        $this->add_action_buttons();
    }
}