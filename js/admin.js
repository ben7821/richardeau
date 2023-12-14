
var selected = null;

$(document).ready(function () {
  $('.room').click(function () {

    if (selected) {
      selected.removeClass('selected');
    }

    selected = $(this);
    selected.addClass('selected');


    const roomId = selected.data('id');
  });

  $('.room').dblclick(function () {
    const roomId = selected.data('id');
    window.location.href = `php/admin/launchroom.php?id=${roomId}`;
  });

  $('#btn-ajouter').click(function () {
    window.location.href = 'php/admin/addroom.php';
  });

  $('#btn-supprimer').click(function () {
    const roomId = selected.data('id');
    window.location.href = `php/admin/deleteroom.php?id=${roomId}`;
  });

  $('#btn-modifier').click(function () {
    const roomId = selected.data('id');
    window.location.href = `php/admin/editroom.php?id=${roomId}`;
  });

  $('#btn-lancer').click(function () {
    const roomId = selected.data('id');
    window.location.href = `php/admin/launchroom.php?id=${roomId}`;
  });
});