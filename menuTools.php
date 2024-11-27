<?php

namespace menu;

class MenuTools
{
    public function menu()
    {
        echo '<p class="subtitle"><a class="link" href="menuAdmin.php">Home</a></p>';
        echo '<p class="subtitle">User Menu</p>';
        echo '<a class="sideList link" href="viewUsers.php">View All Users</a>';
        echo '<a class="sideList link" href="addUsers.php">Add User</a>';
        echo '<a class="sideList link" href="updatePass.php">Update Password</a>';
        echo '<a class="sideList link" href="deleteUser.php">Delete User</a>';
        echo '<p class="subtitle">Products Menu</p>';
        echo '<a class="sideList link" href="viewProducts.php">View All Products</a>';
        echo '<a class="sideList link" href="addProduct.php">Add Products</a>';
        //echo '<a class="sideList link" href="">Update Products</a>';
        echo '<a class="sideList link" href="deleteProduct.php">Delete Products</a>';
        echo '<p class="subtitle"><a class="link" href="index.html">Log Out</a></p>';
    }
    public function mainMenu(){
        echo '<input class="searchInput" type="text" placeholder="Search...">';
        
        echo '<p class="subtitle"><a class="link" href="home.php">Home</a></p>';
        echo '<p class="subtitle">Explore</p>';
        //types
        echo '<a class="sideList link" href="userBOK.php">Books</a>';
        echo '<a class="sideList link" href="userCOM.php">Comics</a>';
        echo '<a class="sideList link" href="userMAG.php">Magazines</a>';
        echo '<a class="sideList link" href="userMAN.php">Manga</a>';
        echo '<a class="sideList link" href="userNWP.php">Newspaper</a>';

        //other
        echo "<p class='subtitle'><a class='link' href='newProd.php'>What's new?</a></p>";
        echo '<p class="subtitle"><a class="link" href="index.html">Log Out</a></p>';
    }
}
