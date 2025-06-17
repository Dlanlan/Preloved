function toggleForm(showRegister = false) {
  const wrapper = document.getElementById("wrapper");
  const isMobile = window.innerWidth <= 768;
  const slider = document.querySelector(".slider");

  if (isMobile) {
    if (showRegister) {
      wrapper.classList.add("register-mode");
    } else {
      wrapper.classList.remove("register-mode");
    }
  } else {
    wrapper.classList.toggle("register-mode", showRegister);
    slider.style.transform = showRegister
      ? "translateX(-50%)"
      : "translateX(0)";
  }
}

window.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.getElementById("wrapper");
  const success = document.getElementById("registerSuccess");
  const isMobile = window.innerWidth <= 768;
  const slider = document.querySelector(".slider");

  if (!isMobile && wrapper.classList.contains("register-mode")) {
    slider.style.transform = "translateX(-50%)";
  }

  if (success) {
    setTimeout(() => {
      wrapper.classList.remove("register-mode");
      if (!isMobile) {
        slider.style.transform = "translateX(0)";
      }
    }, 2000);
  }
});
