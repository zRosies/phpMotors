'use strict';

document.addEventListener('DOMContentLoaded', function () {
  function buildInventoryList(data) {
    let inventoryDisplay = document.getElementById('inventoryDisplay');
    // Set up the table labels
    let dataTable = '<thead>';
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
    dataTable += '</thead>';
    // Set up the table body
    dataTable += '<tbody>';
    // Iterate over all vehicles in the array and put each in a row
    data.forEach(function (element) {
      console.log(element.invId + ', ' + element.invModel);
      dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`;
      dataTable += `<td><a href='/phpmotors/vehicles?action=mod&invId=${element.invId}' title='Click to modify'>Modify</a></td>`;
      dataTable += `<td><a href='/phpmotors/vehicles?action=del&invId=${element.invId}' title='Click to delete'>Delete</a></td></tr>`;
    });
    dataTable += '</tbody>';
    // Display the contents in the Vehicle Management view
    inventoryDisplay.innerHTML = dataTable;
  }

  let classificationList = document.querySelector('#classificationId');

  classificationList.addEventListener('change', (e) => {
    let classificationId = e.target.value;
    let classIdUrl =
      '/phpmotors/vehicles/index.php?action=getInventoryItems&classificationId=' +
      classificationId;
    fetch(classIdUrl)
      .then((response) => {
        if (response.ok) {
          return response.json();
        }
        throw Error('Network response was not OK');
      })
      .then((data) => {
        console.log(data);
        buildInventoryList(data);
      });
  });
});
