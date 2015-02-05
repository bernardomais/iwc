APP = {
    validation: function () {
        $("input, select, textarea").not("[type=submit]").jqBootstrapValidation({
            semanticallyStrict: true,
            sniffHtml: false
        });

    },
    notification: function () {
        $('div[data-notification-type]').each(function () {
            var text = $(this).text(),
                    type = $(this).attr('data-notification-type');
            $.bootstrapGrowl(text, {
                type: type,
                offset: {
                    from: "top",
                    amount: 20
                },
                align: "center",
                delay: 7000,
                allow_dismiss: true,
                stackup_spacing: 10
            });
        });
    },
    init: function () {
        this.notification();
        this.validation();
    }
};
$(function () {
    APP.init();
});