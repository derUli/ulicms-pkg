$(() => {
    $('.checkall').on('click', (event) => {
        const target = event.currentTarget;
        $(".patch-checkbox").prop('checked', target.checked);
    });
});