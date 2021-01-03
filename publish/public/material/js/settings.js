$(document).ready(function() {
  $().ready(function() {
      $sidebar = $('.sidebar');
      $full_page = $('.full-page');
      $sidebar_responsive = $('body > .navbar-collapse');
      if (localStorage.settings_sidebarBackground) {
          sidebarBackground(localStorage.settings_sidebarBackground);
      }
      if (localStorage.settings_filterColor) {
          filterColor(localStorage.settings_filterColor);
      }

      function filterColor(new_color){
          let currentActive = $(".fixed-plugin .active-color span[data-color='" + new_color + "']");
          currentActive.siblings().removeClass('active');
          currentActive.addClass('active');

          if ($sidebar.length != 0) {
              $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
              $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
              $sidebar_responsive.attr('data-color', new_color);
          }
      }
      function sidebarBackground(new_color) {
          let currentActive = $(".fixed-plugin .background-color .badge[data-background-color='" + new_color + "']");
          currentActive.siblings().removeClass('active');
          currentActive.addClass('active');

          if ($sidebar.length != 0) {
              $sidebar.attr('data-background-color', new_color);
          }
      }

      $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
              if (event.stopPropagation) {
              event.stopPropagation();
              } else if (window.event) {
              window.event.cancelBubble = true;
              }
          }
      });

      $('.fixed-plugin .active-color span').click(function() {
          let new_color = $(this).data('color');
          localStorage.settings_filterColor = new_color;
          filterColor(new_color);
      });

      $('.fixed-plugin .background-color .badge').click(function() {
          let new_color = $(this).data('background-color');
          localStorage.settings_sidebarBackground = new_color;
          sidebarBackground(new_color)
      });

      $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

            if ($input.prop('checked')) {
                localStorage.settings_sidebar_mini_active = 'true'
            } else {
                localStorage.settings_sidebar_mini_active = 'false';
                console.log('aaa');
            }

          if (localStorage.settings_sidebar_mini_active == 'false') {
              $('body').removeClass('sidebar-mini');
              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {
              $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
              setTimeout(function() {
              $('body').addClass('sidebar-mini');
              }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
              window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
              clearInterval(simulateWindowResize);
          }, 1000);

      });
  });
});

$(document).ready(function() {
  setTimeout(function() {
      // after 1000 ms we add the class animated to the login/register card
      $('.card').removeClass('card-hidden');
  }, 700);
});
