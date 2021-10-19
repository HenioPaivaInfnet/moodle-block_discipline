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
namespace block_discipline\output;
defined('MOODLE_INTERNAL') || die();

use renderable;
use renderer_base;
use templatable;
use stdClass;

class discipline implements renderable, templatable {

    /**
     * Array de cursos que o usuario está inscrito
     * e serão retornados para o template
     */
    
    public $disciplinas = array();

    public $link;

    public function export_for_template(renderer_base $output) {
        global $CFG;

        $link = $CFG->wwwroot . '/course/view.php?id=';

        $data = new stdClass();
        $data->link = $link;
        return $data;
    }
}