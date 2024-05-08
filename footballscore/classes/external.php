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
 * External API for local_footballscore.
 *
 * @package    local_footballscore
 * @copyright  2021 Shadman Ahmed
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->dirroot . "/local/footballscore/locallib.php");


class local_footballscore_external extends external_api {
    /**
     * Returns description of method parameters.
     * @return external_function_parameters
     */
    public static function delete_score_by_id_parameters(): external_function_parameters {
        return new external_function_parameters(
            array(
                'scoreid' => new external_value(PARAM_INT, 'score id'),
            )
        );
    }

    /**
     * Delete score by id function.
     *
     * @param int $scoreid
     * @return array
     * @throws moodle_exception
     */
    public static function delete_score_by_id(int $scoreid): array {
        global $DB;

        $warnings = array();

        local_footballscore_delete_score($scoreid);

        return array(
            'scoreid' => $scoreid,
            'warnings' => $warnings
        );

    }

    /**
     * Returns description of method result value.
     * @return external_description
     */
    public static function delete_score_by_id_returns() {
        return new external_single_structure(
            array(
                'scoreid' => new external_value(PARAM_INT, 'score id'),
                'warnings' => new external_warnings()
            )
        );
    }
}