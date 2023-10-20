// function data() {
//   function getThemeFromLocalStorage() {
//     // if user already changed the theme, use it
//     if (window.localStorage.getItem('dark')) {
//       return JSON.parse(window.localStorage.getItem('dark'))
//     }

//     // else return their preferences
//     return (
//       !!window.matchMedia &&
//       window.matchMedia('(prefers-color-scheme: dark)').matches
//     )
//   }

//   function setThemeToLocalStorage(value) {
//     window.localStorage.setItem('dark', value)
//   }

//   return {
//     dark: getThemeFromLocalStorage(),
//     toggleTheme() {
//       this.dark = !this.dark
//       setThemeToLocalStorage(this.dark)
//     },
//     isSideMenuOpen: false,
//     toggleSideMenu() {
//       this.isSideMenuOpen = !this.isSideMenuOpen
//     },
//     closeSideMenu() {
//       this.isSideMenuOpen = false
//     },
//     isNotificationsMenuOpen: false,
//     toggleNotificationsMenu() {
//       this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
//     },
//     closeNotificationsMenu() {
//       this.isNotificationsMenuOpen = false
//     },
//     isProfileMenuOpen: false,
//     toggleProfileMenu() {
//       this.isProfileMenuOpen = !this.isProfileMenuOpen
//     },
//     closeProfileMenu() {
//       this.isProfileMenuOpen = false
//     },
//     isPagesMenuOpen: false,
//     togglePagesMenu() {
//       this.isPagesMenuOpen = !this.isPagesMenuOpen
//     },
//     // Modal
//     isModalOpen: false,
//     trapCleanup: null,
//     openModal() {
//       this.isModalOpen = true
//       this.trapCleanup = focusTrap(document.querySelector('#modal'))
//     },
//     closeModal() {
//       this.isModalOpen = false
//       this.trapCleanup()
//     },
//   }
// }


function data() {
  function getThemeFromLocalStorage() {
    // if the user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  function togglefullscreen() {
    if (!document.fullscreenElement) {
      // If the page is not in full-screen mode, request full screen
      if (document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      } else if (document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if (document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen();
      } else if (document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
      }
    } else {
      // If the page is in full-screen mode, exit full screen
      if (document.exitFullscreen) {
        document.exitFullscreen();
      } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
      } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
      } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
      }
    }
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
    togglefullscreen, // Add the toggleFullScreen function to your data object
  }
}
