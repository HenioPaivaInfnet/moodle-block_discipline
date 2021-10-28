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
 * Competencies to review renderable.
 *
 * @package    block_discipline
 * @copyright  Henio Paiva and Gustavo Silveira
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_discipline;

defined('MOODLE_INTERNAL') || die();

class courses {

    public $timeforsql;

    public function get_enrolled_courses($datavalue = 2, $currentpage ) {
        global $DB, $USER, $CFG;

        $links = $CFG->wwwroot . '/course/view.php?id=';

        $timenow = time();

        $limit = 15;

        $offset = $currentpage * $limit;

        switch($datavalue){
            case 1:
                $this->timeforsql = "ORDER BY disciplina.startdate DESC, disciplina.shortname ";
                break;
            case 2:
                $this->timeforsql = "AND disciplina.startdate < :timenow AND disciplina.enddate > :timenow2 ORDER BY disciplina.startdate DESC, disciplina.shortname ";
                break;
            case 3:
                $this->timeforsql = "AND disciplina.startdate > :timenow ORDER BY disciplina.startdate DESC, disciplina.shortname ";
                break;
            case 4:
                $this->timeforsql = "AND disciplina.enddate < :timenow ORDER BY disciplina.startdate DESC, disciplina.shortname ";
                break;
        }

        $params = [
            'userid' => $USER->id,
            'timenow' => $timenow,
            'timenow2' => $timenow,
            'links' => $links
        ];

        $sql = "SELECT disciplina.id courseid, disciplina.fullname fullname,
        bloco.name bloco, turma.name turma, papel.name papel,
        CONCAT(:links, disciplina.id) links
        FROM {user} usuario
        JOIN {role_assignments} ra ON usuario.id = ra.userid
        JOIN {context} cxt ON ra.contextid = cxt.id
        JOIN {course} disciplina ON disciplina.id = cxt.instanceid
        JOIN {course_categories} bloco ON bloco.id = disciplina.category
        JOIN {course_categories} turma ON bloco.parent = turma.id
        JOIN {role} papel ON ra.roleid = papel.id
        WHERE cxt.contextlevel = 50 AND usuario.id = :userid " . $this->timeforsql;

        $result = $DB->get_records_sql($sql, $params, $offset, $limit);

        return $result;
    }
}