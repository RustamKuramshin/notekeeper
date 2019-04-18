const noteTemp = '<div class="note">'
    + '<a href="#" class="button remove">X</a>'
    + '<div class="note_cnt">'
    + '<textarea class="title" placeholder="Заметка #!"></textarea>'
    + '<textarea class="cnt" placeholder="Напишите текст заметки"></textarea>'
    + '</div>'
    + '</div>';

let noteZindex = 1;

function deleteNote() {
    $(this).parent('.note').hide("puff", {percent: 133}, 250);
}

function newNote() {
    $(noteTemp).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
        function () {
            $(this).zIndex(++noteZindex);
        });

    $('.remove').click(deleteNote);

    return false;
}

$(document).ready(function () {

    $("#board").height($(document).height());

    $("#add_new").click(newNote);

    $('.remove').click(deleteNote);

    newNote();

    return false;
});