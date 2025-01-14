<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="d-flex flex-column flex-shrink-0 p-3 bg-light position-fixed top-0 start-0 vh-100" style="width: 280px;" dir="rtl">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>
    
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="employees.php" class="nav-link <?php echo $current_page == 'employees.php' ? 'active text-white bg-purple' : 'link-dark'; ?>" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                ادارة الموظفين
            </a>
        </li>
        <li>
            <a href="stores.php" class="nav-link <?php echo $current_page == 'stores.php' ? 'active text-white bg-purple' : 'link-dark'; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg> 
                ادارة المتاجر
            </a>
        </li>
        <li>
            <a href="orders.php" class="nav-link <?php echo $current_page == 'orders.php' ? 'active text-white bg-purple' : 'link-dark'; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                الطلبات
            </a>
        </li>
        <li>
            <a href="drivers.php" class="nav-link <?php echo $current_page == 'drivers.php' ? 'active text-white bg-purple' : 'link-dark'; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                السائقين
            </a>
        </li>
        <li>
            <a href="deliveris.php" class="nav-link <?php echo $current_page == 'deliveris.php' ? 'active text-white bg-purple' : 'link-dark'; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                ارسال الطلبيات
            </a>
        </li>
        <li>
            <a href="reports.php" class="nav-link <?php echo $current_page == 'reports.php' ? 'active text-white bg-purple' : 'link-dark'; ?>">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                التقارير
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
            <li><a class="dropdown-item" href="#">مشروع جديد...</a></li>
            <li><a class="dropdown-item" href="#">الإعدادات</a></li>
            <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">تسجيل الخروج</a></li>
        </ul>
    </div>
</div>

<!-- Add Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- Add custom CSS for active link -->
<style>
    .bg-purple {
        background-color: #6f42c1 !important;
    }
</style>