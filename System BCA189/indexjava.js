function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const content = document.getElementById('mainContent');
  const topbar = document.querySelector('.topbar');

  sidebar.classList.toggle('hidden');
  content.classList.toggle('shifted');

  if (sidebar.classList.contains('hidden')) {
    topbar.style.left = '20px';
    topbar.style.width = 'calc(100% - 20px)';
  } else {
    topbar.style.left = '250px';
    topbar.style.width = 'calc(100% - 250px)';
  }
}
