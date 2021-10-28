define(['core/ajax', 'core/templates', 'core/notification']
    , function (Ajax, Templates, notification) {
        let init = function (value = 2, currentpage) {
            var promises = Ajax.call([
                { methodname: 'block_discipline_get_enrolled_courses', args: { datavalue: value, currentpage: currentpage } }
            ]);
            promises[0].done(function (response) {
                console.log(response);
                page(response.length);
                template(response);
            }).fail(notification.exception);
        };

        const template = function (params) {
            let context = {
                disciplinas: params
            };
            Templates.renderForPromise('block_discipline/courselist', context)
                .then(({ html, js }) => {
                    Templates.replaceNodeContents('#lista-cursos', html, js);
                })
                .catch(notification.exception);
        };

        const page = function(length) {
            let pageLenght = document.getElementById('pagina');
            pageLenght.dataset.length = length;
        };
        return { init, template };
    });