$(document).ready(function () {
    /*filters*/
    $(function() {
        var filterBlockWrapper = $(".filter-block-wrapper"),
            form = filterBlockWrapper.find("form"),
            radioButton = filterBlockWrapper.find("input[type=radio]")
            selectButton = filterBlockWrapper.find("select");

        radioButton.change(function() {
            form.submit();
        });
        selectButton.change(function() {
            form.submit();
        });
    })
});
