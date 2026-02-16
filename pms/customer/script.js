

function toggleSidebar(){
  document.getElementById("sidebar")
    .classList.toggle("sidebar-collapsed");
}

function toggleMobileSidebar(){
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  sidebar.classList.toggle("-translate-x-full");
  overlay.classList.toggle("hidden");
}


function toggleProfile(event) {
  event.stopPropagation(); // Prevent outside click trigger
  document.getElementById("profileMenu").classList.toggle("hidden");
}

// Close when clicking outside
document.addEventListener("click", function(event) {
  const wrapper = document.getElementById("profileWrapper");
  const menu = document.getElementById("profileMenu");

  if (!wrapper.contains(event.target)) {
    menu.classList.add("hidden");
  }
});


