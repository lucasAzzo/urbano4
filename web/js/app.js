// Database service reference
var db = firebase.database().ref('player/');
var db_notif = firebase.database().ref('notifications/');

db_notif.on('value', function (snapshot) {
    var notifications = snapshot.val();
    var tot_notif = notifications.len();

},function (errorObject) {
    console.log("The read failed: " + errorObject.code);
})

db.on('value', function (snapshot) {
    var players = snapshot.val();
    $("#playersTable tbody").empty();

    var row = "";

    for (player in players) {
        row += '<tr id="' + player + '">' +
            '<td class="name">' + players[player].name + '</td>' +
            '<td class="mail">' + players[player].mail + '</td>' +
            '<td class="number">' + players[player].number + '</td>' +
            '<td class="position">' + players[player].position + '</td>' +
            '<td> <div class="btnEdit btn btn-warning glyphicon glyphicon-edit"></div> </td>' +
            '<td> <div class="btnDelete btn btn-danger glyphicon glyphicon-remove"></div> </td>' +
            '</tr>'
    }

    $("#playersTable tbody").append(row);
    row = "";
}, function (errorObject) {
    console.log("The read failed: " + errorObject.code);
})

//Get players
var savePlayer = function () {
    var player_number = $("#number").val();
    var dataPlayer = {
        name: $("#name").val(),
        mail: $("#mail").val(),
        number: player_number,
        position: $("#position option:selected").text()
    }

    db.push().set(dataPlayer)
}

$("#btnSend").click(savePlayer);

var saveNotification = function (from, to, type, read, icon, title, content) {
    var notification = {
        from: from,
        to: to,
        type: type,
        read: read,
        icon: icon,
        title:title,
        content:content
    }
    db_notif.push().set(notification)
}

//Add player