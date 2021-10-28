<?php

require('../../config.php');

global $DB, $USER, $CFG;

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/blocks/discipline/teste.php'));
$PAGE->set_context($context);
$PAGE->set_title('Gerenciar mensagens');
$PAGE->set_heading('Qualquer coisa de novo');

$links = $CFG->wwwroot . '/course/view.php?id=';

$userid = $USER->id;

$params = [
    'userid' => $USER->id
];

$sql = "SELECT disciplina.id courseid, disciplina.fullname fullname,
        bloco.name bloco, turma.name turma, papel.name papel
        FROM {user} usuario
        JOIN {role_assignments} ra ON usuario.id = ra.userid
        JOIN {context} cxt ON ra.contextid = cxt.id
        JOIN {course} disciplina ON disciplina.id = cxt.instanceid
        JOIN {course_categories} bloco ON bloco.id = disciplina.category
        JOIN {course_categories} turma ON bloco.parent = turma.id
        JOIN {role} papel ON ra.roleid = papel.id
        WHERE cxt.contextlevel = 50 AND usuario.id = :userid 
        ORDER BY disciplina.startdate DESC, disciplina.shortname ";

$results = $DB->get_records_sql($sql, $params);

echo $OUTPUT->header();

foreach($results as $result){
    echo "<p> $result->courseid | $result->fullname </p>";
}

echo $OUTPUT->footer();