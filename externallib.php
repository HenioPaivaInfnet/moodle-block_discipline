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
 * Version details
 *
 * @package   block_discipline
 * @copyright Henio Paiva and Gustavo Silveira
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use block_discipline\courses;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');

class block_discipline_external extends external_api
{
    /**
     * Parametros requiridos pela api para executar função
     * @return external_funciotion_parameters
     */
    public static function get_enrolled_courses_parameters()
    {
        return new external_function_parameters(
            array(
                'datavalue' => new external_value(PARAM_INT, 'datavalue', VALUE_DEFAULT, 2)
            )
        );
    }

    public static function get_enrolled_courses($datavalue) {
        //$datavalue = self::validate_parameters(PARAM_INT, self::get_enrolled_courses_parameters, array('datavalue'=>$datavalue));

        $courses = new courses();

        $enrolled = $courses->get_enrolled_courses($datavalue);

        return $enrolled;
    }

    public static function get_enrolled_courses_returns() {
        return new external_multiple_structure(
                new external_single_structure(
                    array(
                        'courseid' => new external_value(PARAM_INT, 'courseid'),
                        'fullname' => new external_value(PARAM_TEXT, 'fullname'),
                        'bloco' => new external_value(PARAM_TEXT, 'bloco'),
                        'turma' => new external_value(PARAM_TEXT, 'turma'),
                        'papel' => new external_value(PARAM_TEXT, 'papel')
                    )
                )
            );
    }
}
