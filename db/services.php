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

$functions = array(
    'local_todolist_delete_task_by_id' => array(
        'classname'   => 'local_todolist_external',
        'methodname'  => 'delete_task_by_id',
        'classpath'   => 'local/todolist/external.php',
        'description' => 'Delete a single task by id',
        'type'        => 'write',
        'ajax'        => true
    ),
);
