function paginationFunction(data, offset) {
  let end;
  if (data.length >= 50) {
    data = data.slice(offset, offset + 50);
    end = data < 51 ? true : false;
  }
  return {data, end}
}

$(document).ready(function () {
  $('#next-btn').click(function () {
    $('#prev-btn').prop('disabled', false);
    paginateCount += 1;
    ajaxCall();
  });
  $('#prev-btn').click(function () {
    $('#next-btn').prop('disabled', false);
    if (paginateCount === 0) {
      $('#prev-btn').prop('disabled', true);
      return;
    }
    paginateCount -= 1;
    ajaxCall();
  });
});
