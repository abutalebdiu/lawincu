
function toggleSidebar(){

    var topheader = document.getElementById("top-header"); // for top header

    var sidebar = document.getElementById("main-sidebar");
    var maincontent = document.getElementById("main-content");

    const left = window.getComputedStyle(sidebar).getPropertyValue('left');

    if(left == '-250px'){

        sidebar.style.left = '0px';

        maincontent.classList.remove("main-content-expand");
        maincontent.classList.add("main-content-collapse");

        topheader.classList.remove("top-header-expand");
        topheader.classList.add("top-header-collapse");

    }else{

        sidebar.style.left = '-250px';

        maincontent.classList.remove("main-content-collapse");
        maincontent.classList.add("main-content-expand");


        topheader.classList.remove("top-header-collapse");
        topheader.classList.add("top-header-expand");

    }

}

jQuery(document).ready(function () {
    jQuery('.scrollbar-inner').scrollbar();
});



$(document).ready(function () {

    window._token = $('meta[name="csrf-token"]').attr('content')


    $('.select-all').click(function () {
      let $select2 = $(this).parent().siblings('.select2')
      $select2.find('option').prop('selected', 'selected')
      $select2.trigger('change')
    })

    $('.deselect-all').click(function () {
      let $select2 = $(this).parent().siblings('.select2')
      $select2.find('option').prop('selected', '')
      $select2.trigger('change')
    })


    $('.treeview').each(function () {
      var shouldExpand = false
      $(this).find('li').each(function () {
        if ($(this).hasClass('active')) {
          shouldExpand = true
        }
      })
      if (shouldExpand) {
        $(this).addClass('active')
      }
    })

    $('.c-header-toggler.mfs-3.d-md-down-none').click(function (e) {

        $('#sidebar').toggleClass('c-sidebar-lg-show');

        setTimeout(function () {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        }, 400);

    });


    // moment.updateLocale('en', {
    //     week: {dow: 1} // Monday is the first day of the week
    //   })

    //   $('.date').datetimepicker({
    //     format: 'YYYY-MM-DD',
    //     locale: 'en',
    //     icons: {
    //       up: 'fas fa-chevron-up',
    //       down: 'fas fa-chevron-down',
    //       previous: 'fas fa-chevron-left',
    //       next: 'fas fa-chevron-right'
    //     }
    //   })

    //   $('.datetime').datetimepicker({
    //     format: 'YYYY-MM-DD HH:mm:ss',
    //     locale: 'en',
    //     sideBySide: true,
    //     icons: {
    //       up: 'fas fa-chevron-up',
    //       down: 'fas fa-chevron-down',
    //       previous: 'fas fa-chevron-left',
    //       next: 'fas fa-chevron-right'
    //     }
    //   })

    //   $('.timepicker').datetimepicker({
    //     format: 'HH:mm:ss',
    //     icons: {
    //       up: 'fas fa-chevron-up',
    //       down: 'fas fa-chevron-down',
    //       previous: 'fas fa-chevron-left',
    //       next: 'fas fa-chevron-right'
    //     }
    //   })
  })
