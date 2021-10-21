define(['core/paged_content_factory', 'core/templates', 'core/notification'],
    function (PagedContentFactory, Templates, Notification) {
        let init = function () {
            PagedContentFactory.createWithLimit(
                2,
                // Callback to load and render the items as the user clicks on the pages.
                function (pagesData, actions) {
                    return pagesData.map(function (pageData) {
                        // Your function to load the data for the given limit and offset.
                        return loadData(pageData.limit, pageData.offset)
                            .then(function (data) {
                                // You criteria for when all of the data has been loaded.
                                if (data.length > 100) {
                                    // Tell the page content code everything has been loaded now.
                                    actions.allItemsLoaded(pageData.pageNumber);
                                }
                                // Your function to render the data you've loaded.
                                return renderData(data);
                            });
                    });
                },
                {
                    controlPlacementBottom: true
                }
            ).then(function (html, js) {
                // Add the paged content into the page.
                Templates.replaceNodeContents('#lista-cursos', html, js);
            }).catch(e => Notification.exception(e));
        };
        let log = () => console.log('Deu certo');
        return { init, log };
    });