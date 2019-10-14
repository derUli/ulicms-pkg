$(() => {
    $('.checkall').on('click', (event) => {
        const target = event.currentTarget;
        $(".package-checkbox").prop('checked', target.checked);
    });
});