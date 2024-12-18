<nav class="navbar navbar-expand-lg" >
    <div class="container-fluid">
    <div class="logo"><a href="foro.php"><img src="../SRC/si.png" width="80%"></a></div>
        <a class="navbar-brand" href="#" style="color:white;">SimaxForo</a>
        <div class="text-center mx-auto currentDisplay">
            <span class="text-white" id="currentPageTitle">Current Page Title</span>
        </div>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="../MAIN/login_register.php">
                    <i class="fas fa-user-circle"></i>
                </a>
                <a class="nav-link" href="../MAIN/panelAdmin.php">
                    <h4>Panel de control</h4>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    // Example: Set the current page title based on the page URL
    const pageTitle = document.getElementById('currentPageTitle');
    const currentPage = window.location.pathname.split('/').pop(); // Get the current page name

    switch (currentPage) {
        case 'login_register.php':
            pageTitle.textContent = 'Login y registro';
            break;
        case 'panelAdmin.php':
            pageTitle.textContent = 'Panel de control';
            break;
        case 'foro.php':
            pageTitle.textContent = 'Foro';
            break;
        default:
            pageTitle.textContent = 'Home'; // Default title
    }
</script>

<style>
    .currentDisplay {
        font-size: 60px;
    }

</style>