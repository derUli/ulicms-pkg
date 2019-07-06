$(function () {
    $('.checkall').on('click', function () {
        $(".site-checkbox").prop('checked', this.checked);
    });
    $("#list-form").on("submit", function (event) {
        event.preventDefault();
        var action = $("select[name='action']").val();
        var url = "index.php?action=" + action;
        var val = [];
        $('.site-checkbox:checked').each(function (i) {
            val[i] = $(this).val();
        });

        url = url + "&sites=" + val.join(",");
        location.href = url;

    });
});