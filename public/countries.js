const table = document.querySelector('table');
const modal = document.getElementsByClassName('modal')[0];
const closeBtn = document.querySelector('.close');
let paginateCount = 0;

function displayState(data, offset = 0) {
  let disp = '';
  if (data.length >= 50) {
    data = data.slice(offset, offset + 50);
  }
  data.forEach(element => {
    disp += `<li>${element.name}</li>`;
  });
  return disp;
}

function loadTable(countries, offset = 0) {
  let displayContent = '';
  let end;
  if (countries.length >= 50) {
    countries = countries.slice(offset, offset + 50);
    end = countries < 51 ? true : false;
  }
  countries.forEach(country => {
    displayContent += `<tr>
         <td>${country['alpha3_code']}</td>
         <td>${country['name']}</td>
         <td>
         	<button class="display-state" id="display-state"  name="${country['alpha3_code']}" type="submit">View States</button>
       </tr>`;
  });
  return { displayContent, end };
}

table.addEventListener('click', (event) => {
  event.preventDefault();
  if (event.target.matches('button')) {
    event.preventDefault();
    modal.style.display = 'block';
    $.ajax({
      url: `../src/fetchState.php?code=${event.target.name}`,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        if (data.RestResponse.result.length === 0) {
          $('ul.modal-display').html(`<li>No state found</li>`);
          return;
        }
        $('ul.modal-display').html(displayState(data.RestResponse.result));
      },
      error: function (error) {
        $('ul.modal-display').text(`Error fetching data`);
      }
    })
  }
});

closeBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

function ajaxCall() {
  let offset = paginateCount * 50;
  $.ajax({
    url: `../src/fetchCountry.php?offset=${offset}`,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      const { end, displayContent } = loadTable(data.RestResponse.result, offset);
      if (end) {
        $('#next-btn').prop('disabled', true);
        return;
      }
      $('tbody').html(displayContent);
    },
    error: function (error) {
      alert('this is error');
    }
  });
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
