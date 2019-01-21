const table = document.querySelector('table');
const modal = document.getElementsByClassName('modal')[0];
const closeBtn = document.querySelector('.close');
let paginateCount = 0;

function loadTable(countries, offset = 0) {
  const {data, end} = paginationFunction(countries, offset);
  let displayContent = '';
  data.forEach((country,index) => {
    displayContent += `<tr>
         <td>${index+offset+1}</td>
         <td>${country['alpha3_code']}</td>
         <td>${country['name']}</td>
         <td>
         <button id="${country['alpha3_code']}" class="display-state" name="${country['name']}" type="submit">View States</button>
         </td>
       </tr>`;
  });
  return { displayContent, end };
}

$('table').click(function () {
  if(event.target.matches('button'))
{
  window.location.href= `states.php?code=${event.target.id}&name=${event.target.name}`;
}})

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
      alert('An error ocurred');
    }
  });
}
