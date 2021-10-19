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

class block_discipline extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_discipline');
    }
    public function get_content() {
        global $OUTPUT;
        if ($this->content !== null) {
            return $this->content;
        }
        //$discipline = new \block_discipline\output\discipline();
        $this->content = new stdClass;
        //$renderer = $this->page->get_renderer('block_discipline');
        //$this->content->text = $renderer->render($discipline);
        $this->content->text = $OUTPUT->render_from_template('block_discipline/index', null);
        $this->content->footer = '';
        return $this->content;
    }
}
