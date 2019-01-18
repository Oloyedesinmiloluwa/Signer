function mapCountriesToTable(data, offset=0){
  let disp='';
  debugger;
  if(data.length >= 50){
    data = data.slice(offset, offset + 50);
  }
  data.forEach(element => {
      disp +=`<li>${element.name}</li>`;
    });
    return disp;
}
