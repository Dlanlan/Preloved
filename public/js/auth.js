function toggleForm(showRegister = false) {
  const wrapper = document.getElementById("wrapper");
  const isMobile = window.innerWidth <= 768;
  const slider = document.querySelector(".slider");

  if (isMobile) {
    // mobile: tampilkan form register dengan slide ke bawah
    if (showRegister) {
      wrapper.classList.add("register-mode");
    } else {
      wrapper.classList.remove("register-mode");
    }
  } else {
    // desktop: geser slider ke kiri/kanan
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

  // Set awal posisi slider desktop
  if (!isMobile && wrapper.classList.contains("register-mode")) {
    slider.style.transform = "translateX(-50%)";
  }

  // Auto kembali ke login jika register sukses
  if (success) {
    setTimeout(() => {
      if (isMobile) {
        wrapper.classList.remove("register-mode");
      } else {
        slider.style.transform = "translateX(0)";
      }
    }, 2000);
  }
});
