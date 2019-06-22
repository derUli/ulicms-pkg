$(function () {
    $('.checkall').on('click', function () {
        $(".package-checkbox").prop('checked', this.checked);
    });
});