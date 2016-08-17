
/**
 *  debug in console,
 *  alias for 'console.log()'
 */
function dd() {
    for (i in args = dd.arguments) {
        console.log(args[i]);
    }
}

function logout() {
    var currentUrl = window.location.href;

    $.post(HOME_URL + "/login/logout", function(data, status) {
        window.location.href = currentUrl;
    });
}

function fillModal() {
    var name = $('#commentform #name').val(),
        date = new Date($.now()),
        comment = $('#commentform #comment').val();

    var dateString = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDate()
        + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();

    $('#modal-head').text(name);
    $('#modal-date').text(dateString);
    $('#modal-comment').text(comment);
}

function acceptFeedback(e) {
    var feedbackBody = e.closest('.media-body'),
        currId = $(feedbackBody).find('.feedback-id').text(),
        currentUrl = window.location.href;

    $.post(HOME_URL, {status: 'accepted', id: currId}, function(data, status) {
        window.location.href = currentUrl;
    });
}

function declineFeedback(e) {
    var feedbackBody = e.closest('.media-body'),
        currId = $(feedbackBody).find('.feedback-id').text(),
        currentUrl = window.location.href;

    $.post(HOME_URL, {status: 'declined', id: currId}, function(data, status) {
        window.location.href = currentUrl;
    });
}

function editFeedback(e) {
    var feedbackBody = e.closest('.media-body'),
        formBody = $('#editFeedBackModal form'),

        currId = $(feedbackBody).find('.feedback-id').text(),
        currName = $(feedbackBody).find('.feedback-name').text(),
        currEmail = $(feedbackBody).find('.feedback-email-text').text(),
        currComment = $(feedbackBody).find('.feedback-comment').text(),

        formId = formBody.find('#id'),
        formName = formBody.find('#name'),
        formEmail = formBody.find('#email'),
        formComment = formBody.find('#comment');

    formId.val(currId);
    formName.val(currName);
    formEmail.val(currEmail);
    formComment.val(currComment);
}

function removeFeedback(e) {
    var feedbackBody = e.closest('.media-body'),
        currId = $(feedbackBody).find('.feedback-id').text(),
        currentUrl = window.location.href;
    
    if (confirm("Are you sure?")) {
        $.post(HOME_URL, {remove: true, id: currId}, function(data, status) {
            window.location.href = currentUrl;
        });
    }
    
    return false;
}
