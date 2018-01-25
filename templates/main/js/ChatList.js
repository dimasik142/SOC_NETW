/**
 * Created by dimasik142
 * Email ivanov.dmytro.ua@gmail.com
 */

function ChatList(param) {
    this.messagesList = JSON.parse(param.messagesList);
    this.senderData = JSON.parse(param.senderData);
    this.receiverData = JSON.parse(param.receiverData);

    this.deleteMessageAjaxUrl = param.deleteMessageAjaxUrl;
    this.changeMessageAjaxUrl = param.changeMessageAjaxUrl;
    this.sendMessageAjaxUrl = param.sendMessageAjaxUrl;
    this.refreshAjaxUrl = param.refreshAjaxUrl;
    this.messageQuantity = param.messageQuantity;
    this.listContainer = param.listContainer;
    this.idMessageToChange = 0;
}

ChatList.prototype = {
    constructor: ChatList,

    init: function init() {
        this.renderList();
    },

    renderList: function renderList() {
        this.clearContainer(this.listContainer);
        var _this = this;
        $.each(_this.messagesList, function (index, item) {
            if (Number(_this.senderData['USER_ID']) === Number(item['SENDER_ID'])){
                data = {
                    text: item['TEXT'],
                    id: item['ID'],
                    time: item['DATA_TIME'],
                    photo: _this.senderData['PHOTO'],
                    name: _this.senderData['NAME'],
                    surename: _this.senderData['SURENAME'],
                    canChange: true
                }
            } else {
                data = {
                    text: item['TEXT'],
                    id: item['ID'],
                    time: item['DATA_TIME'],
                    photo: _this.receiverData['PHOTO'],
                    name: _this.receiverData['NAME'],
                    surename: _this.receiverData['SURENAME'],
                    canChange: false
                }
            }
            _this.renderMess(data)
        });
        _this.scrollPoint();

    },

    renderMess: function renderMess(data) {
        var container = $('<div/>', {
            class: 'message'
        }).appendTo( this.listContainer );

        $('<img>', {
            class: 'dialog_photo_small',
            src: data['photo']
        }).appendTo(container);

        $(container).append(data['name'] + ' ' + data['surename']);

        var messageContainer = $('<div/>', {
            class: 'messageContainer'
        }).appendTo( container );

        $(messageContainer).append(data['text']);

        if (data['canChange']) {
            var deleteContainer = $('<a>', {
                class: 'deleteMessageButton',
                onclick: 'chatList.deleteMessage(this.getAttribute(\'data-id\'))'
            }).appendTo(container).attr('data-id', data['id']);

            $(deleteContainer).html('Видалити');

            var changeContainer = $('<a>', {
                class: 'changeMessage',
                onclick: 'chatList.showChangeMessageForm(this.getAttribute(\'data-id\'), this.getAttribute(\'data-text\'))'
            }).appendTo(container).attr('data-id', data['id']).attr('data-text', data['text']);

            $(changeContainer).html('Змінити /');
        }
        var dataContainer = $('<div>', {
            class: 'data'
        }).appendTo(container);

        $('<div>', {
            class: 'data'
        }).appendTo(container);

        $(dataContainer).append(data['time']);

        $('<br>').appendTo( this.listContainer );
    },

    deleteMessage: function deleteMessage(id) {
        var _this = this;
        if (id) {
            $.ajax({
                type: 'POST',
                url: this.deleteMessageAjaxUrl,
                data: {
                    messageId: id
                },
                dataType: 'json'
            }).done(function (result) {
                _this.refreshMessagesArray(true);
            }).fail(function (result) {
                console.log('Виникла помилка при видаленні повідомлення');
            });
        }
    },

    showChangeMessageForm: function showChangeMessageForm(id, text) {
        this.idMessageToChange = id;
        $('#newMassageForm').hide();
        $('#newChangeMassage').val(text);
        $('#changeMassageForm').show();
    },

    сhangeMessage: function showChangeMessageForm(text) {
        var _this = this;
        if (text && this.idMessageToChange) {
            $.ajax({
                type: 'POST',
                url: this.changeMessageAjaxUrl,
                data: {
                    text: text,
                    messageId: this.idMessageToChange
                },
                dataType: 'json'
            }).done(function (result) {
                _this.refreshMessagesArray(true);
            }).fail(function (result) {
                console.log('Виникла помилка при редагуванні повідомлення');
            });
        }
    },

    sendMessage: function sendMessage(text) {
        var _this = this;
        if (text) {
            $.ajax({
                type: 'POST',
                url: this.sendMessageAjaxUrl,
                data: {
                    text:text,
                    receiver_id:this.receiverData['USER_ID']
                },
                dataType: 'json'
            }).done(function (result) {
                _this.refreshMessagesArray(true);
            }).fail(function (result) {
                console.log('Виникла помилка при відправленні повідомлення');
            });
        }
    },

    refreshMessagesArray: function refreshMessagesArray(scroll) {
        var _this = this;
        $.ajax({
            type: 'POST',
            url: this.refreshAjaxUrl,
            data: {
                receiver_id: this.receiverData['USER_ID'],
                quantity: this.messageQuantity
            },
            dataType: 'json'
        }).done(function (result) {
            _this.messagesList = result;
            _this.renderList();
            if(scroll){
                _this.scrollPoint();
            }
        }).fail(function () {
            console.log('Виникла помилка при оновленні списку повідомлень');
        });
    },

    clearContainer: function clearContainer(id) {
        $(id).empty();
    },

    scrollPoint: function addNewScrollPoint() {
        $(this.listContainer).scrollTop(9999999)
    }
};