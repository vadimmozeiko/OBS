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

window.addEventListener('DOMContentLoaded', (event) => {
    sortTableByColumn(document.querySelector('table'), 1, false);
    document.querySelectorAll('.table-sortable .sortable').forEach(headerCell => {
        headerCell.addEventListener('click', () => {
            const tableElement = headerCell.parentElement.parentElement.parentElement;
            const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
            const currentIsAsc = headerCell.classList.contains('th-sort-asc');

            sortTableByColumn(tableElement, headerIndex, !currentIsAsc);
        })
    })
});


$(document).ready(function () {
    $('.order, .date, .title, .status, .name').addClass('hidden');
    $('.sort-order').click(function () {
        $('.date, .title, .status, .name').addClass('hidden');
        $('.order').removeClass('hidden').toggleClass('fa-sort-numeric-down');
    })
    $('.sort-date').click(function () {
        $('.order, .title, .status, .name').addClass('hidden');
        $('.date').removeClass('hidden').toggleClass('fa-sort-numeric-down');
    });
    $('.sort-title').click(function () {
        $('.date, .order, .status, .name').addClass('hidden');
        $('.title').removeClass('hidden').toggleClass('fa-sort-alpha-down');
    });
    $('.sort-name').click(function () {
        $('.date, .order, .status, .title').addClass('hidden');
        $('.name').removeClass('hidden').toggleClass('fa-sort-alpha-down');
    });
    $('.sort-status').click(function () {
        $('.date, .title, .order, .name').addClass('hidden');
        $('.status').removeClass('hidden').toggleClass('fa-sort-alpha-down');
    });

});


// TABLE SORT END =====================================================================



// SEARCH FIELD =======================================================================

$(document).ready(function(){
    $("#search-field").on("keyup", function() {
        const value = $(this).val().toLowerCase();
        $(".table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


// END SEARCH FIELD ===================================================================
