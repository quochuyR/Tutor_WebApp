<!DOCTYPE html>
<html lang="en">
<?php

$title = "Trang chủ";
include "../inc/head.php";

?>

<body>
    <div class="container-fluid px-0">
        <header class="row g-0 m-0">

            <?php
            $nav_tutor_active = "active";
            include "../inc/header.php";
            ?>

        </header>
        <div id="main" class="container ">
            <?php include "../inc/slide.php" ?>
            <div class=" container pt-5 text-white">
                <!-- <header class="py-5 mt-5">
                    <h1 class="display-4">Transparent Navbar</h1>
                    <p class="lead mb-0">Using Bootstrap 4 and Javascript, create a transparent navbar which changes its style on scroll.</p>
                    <p class="lead mb-0">Snippet by
                        <a href="https://bootstrapious.com" class="text-white">
                            <u>Bootstrapious</u></a>
                    </p>
                </header> -->
                <div class="py-5">
                    <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat!
                        Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <div class="py-5">
                    <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat!
                        Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
        <footer class="row g-0 m-0 w-100 py-4 px-2 flex-shrink-0">

            <?php include '../inc/footer.php' ?>

        </footer>

    </div>

    <?php

    include "../inc/script.php"
    ?>

</body>

</html>