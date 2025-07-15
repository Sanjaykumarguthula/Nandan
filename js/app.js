$(document).ready(function () {
  document.querySelectorAll('.menu-item-has-children > a').forEach(item => {
    item.addEventListener('click', function (event) {
      event.preventDefault(); // Prevent default link behavior

      let parent = this.parentElement;
      let subMenu = parent.querySelector('.sub-menu');

      if (subMenu.style.display === 'block') {
        subMenu.style.display = 'none';
        parent.classList.remove('active');
      } else {
        // Close only sibling submenus, not parent ones
        let siblings = parent.parentElement.querySelectorAll('.sub-menu');
        siblings.forEach(sibling => {
          if (sibling !== subMenu) {
            sibling.style.display = 'none';
            sibling.parentElement.classList.remove('active');
          }
        });

        // Open clicked menu
        subMenu.style.display = 'block';
        parent.classList.add('active');
      }
    });
  });
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 100) {
      $('.scroll-up').addClass('open');
      $('body').addClass('fixed-header');
    } else {
      $('body').removeClass('fixed-header');
      $('.scroll-up').removeClass('open');
    }
  });

  $('.scroll-up').click(function () {
    $('.scroll-up').removeClass('open');
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  });
  
  // Tab handling logic
  // function getQueryParam(param) {
  //   let urlParams = new URLSearchParams(window.location.search);
  //   return urlParams.get(param);
  // }
  // function updateQueryParam(tabId) {
  //   let newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?tab=" + tabId;
  //   window.history.pushState({ path: newUrl }, "", newUrl);
  // }
  // document.querySelectorAll(".sub-menu.market-place .menu-item a").forEach(menuItem => {
  //   menuItem.addEventListener("click", function (event) {
  //     event.preventDefault(); 
  //     let tabId = this.getAttribute("data-tab");
  //     if (tabId) {
  //       let targetPage = window.location.pathname.includes("business-development.html") ? "business-development.html" : "business-development.html";
  //       window.location.href = targetPage + "?tab=" + tabId;
  //     }
  //   });
  // });

  // document.querySelectorAll(".nav-link").forEach(tab => {
  //   tab.addEventListener("click", function () {
  //     let targetId = this.getAttribute("data-bs-target").substring(1); 
  //     updateQueryParam(targetId);
  //   });
  // });

  // let activeTab = getQueryParam("tab");
  // if (activeTab) {
  //   let tabButton = document.querySelector(`[data-bs-target="#${activeTab}"]`);
  //   if (tabButton) {
  //     tabButton.click(); 
  //   }
  // } else {
  //   let defaultTab = document.querySelector(".nav-link");
  //   if (defaultTab) defaultTab.click();
  // }

});  