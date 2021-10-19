define(['core/ajax', 'core/templates', 'core/notification']
        , function(Ajax, Templates, displayException) {

    let init = function(value = 2) {
        var promises = Ajax.call([
            { methodname: 'block_discipline_get_enrolled_courses' , args:{ datavalue: value }}
        ]);

        promises[0].done(function(response) {
            template(response);
        }).fail(displayException);
    };

    const template = function(params) {
        let context = {
            disciplinas: params
        };
        Templates.renderForPromise('block_discipline/courselist', context)
            .then(({html, js}) => {
                Templates.replaceNodeContents('#lista-cursos', html, js);
            })
            .catch(displayException);
    };

    return { init, template };
});