$(() => {
    $('.checkall').on('click', (event) => {
        const target = event.currentTarget;
        $(".site-checkbox").prop('checked', target.checked);
    });
    $("#list-form").on("submit", (event) => {
        event.preventDefault();
        const action = $("select[name='action']").val();
        let url = "index.php?action=" + action;
        const values = [];
        $('.site-checkbox:checked').each(function (i, element) {
            values.push($(element).val());
        });
        url = url + "&sites=" + values.join(",");
        location.href = url;
    });
});