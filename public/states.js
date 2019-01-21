let paginateCount = 0;
let code;
  if(window.location.search){
    code = window.location.search.substr(6,3);
  }

function displayState(states, offset = 0) {
  const {data, end} = paginationFunction(states, offset);
  let disp = '';
  data.forEach(element => {
    disp += `<li>${element.id}.    ${element.name}</li>`;
  });
  return {disp, end};
}
function ajaxCall() {
  let offset = paginateCount * 50;
  $.ajax({
    url: `../src/fetchState.php?code=${code}`,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      if (data.RestResponse.result.length === 0) {
        $('ul.modal-display').html(`<li>No state found</li>`);
        return;
      }
     const {disp, end} = displayState(data.RestResponse.result, offset);
     if (end) {
      $('#next-btn').prop('disabled', true);
      return;
    }
      $('ul.modal-display').html(disp);
    },
    error: function (error) {
      $('ul.modal-display').text(`Error fetching data`);
    }
  });
}
$(document).ready(function () {
  ajaxCall();
});
