require('./bootstrap');


// TABLE SORT =====================================================================
function sortTableByColumn(table, column, asc = true) {
    const dirModifier = asc ? 1 : -1;

    // get table elements
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll('tr'));

    // sort the table elements
    const sortedRows = rows.sort((a, b) => {
        const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

    // remove all table rows from table
    while (tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    // add sorted rows to table
    tBody.append(...sortedRows);


    // store current order sorting way
    table.querySelectorAll('.sortable').forEach(th => th.classList.remove('th-sort-asc', 'th-sort-desc'));
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-asc', asc);
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle('th-sort-desc', !asc);
}


sortTableByColumn(document.querySelector('table'), 1, true);
document.querySelectorAll('.table-sortable .sortable').forEach(headerCell => {
    headerCell.addEventListener('click', () => {
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAsc = headerCell.classList.contains('th-sort-asc');

        sortTableByColumn(tableElement, headerIndex, !currentIsAsc);
    })
})

$(document).ready(function () {
    $('.order, .date, .title, .status').addClass('hidden');
    $('.sort-order').click(function () {
        $('.date, .title, .status').addClass('hidden');
        $('.order').removeClass('hidden').toggleClass('fa-sort-numeric-down');
    })
    $('.sort-date').click(function () {
        $('.order, .title, .status').addClass('hidden');
        $('.date').removeClass('hidden').toggleClass('fa-sort-numeric-down');
    });
    $('.sort-title').click(function () {
        $('.date, .order, .status').addClass('hidden');
        $('.title').removeClass('hidden').toggleClass('fa-sort-alpha-down');
    });
    $('.sort-status').click(function () {
        $('.date, .title, .order').addClass('hidden');
        $('.status').removeClass('hidden').toggleClass('fa-sort-alpha-down');
    });

});


// TABLE SORT END =====================================================================
