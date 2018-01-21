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
}

ChatList.prototype = {
    constructor: ChatList,

    init: function init() {
        this.renderList();
    },

    renderList: function renderList() {
        this.clearContainer(this.listContainer);
        var _this = this;
        $.each(_this.messagesList, function (index, payType) {
            if (Number(_this.senderData['user_id']) === Number(payType['sender_id'])){
                data = {
                    text: payType['text'],
                    id: payType['id'],
                    time: payType['time'],
                    photo: _this.senderData['photo'],
                    name: _this.senderData['name'],
                    surename: _this.senderData['surename']
                }
            } else {
                data = {
                    text: payType['text'],
                    id: payType['id'],
                    time: payType['time'],
                    photo: _this.receiverData['photo'],
                    name: _this.receiverData['name'],
                    surename: _this.receiverData['surename']
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

        var dataContainer = $('<div>', {
            class: 'data'
        }).appendTo(container);

        var deleteContainer = $('<a>', {
            class: 'delButton',
        }).appendTo(container).attr('data-id',);

        $(deleteContainer).html('Видалити');

        // $('<div>', {
        //     class: 'data'
        // }).appendTo(container);

        $(dataContainer).append(data['time']);

        $('<br>').appendTo( this.listContainer );
    },

    // deleteMessage: function deleteMessage() {
    //
    // },

    // changeMessage: function changeMessage() {
    //
    // },

    sendMessage: function sendMessage(text) {
        var _this = this;
        if (text) {
            $.ajax({
                type: 'POST',
                url: this.sendMessageAjaxUrl,
                data: {
                    text:text,
                    receiver_id:this.receiverData['user_id']
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
                receiver_id: this.receiverData['user_id'],
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
        $(this.listContainer).scrollTop(9999)
    }
};