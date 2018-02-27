<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
                <link rel="stylesheet" type="text/css" href="all.css">
   <script src="main.js"></script>
        <title>CraftCourt</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id = "header">
            <div id="website_name">
                <a id="website_link" href="index.html" > 
                    CraftCourt
                </a>
            </div>
           <div class="search-container">
                <form action="walapatlga.html">
                   <input type="text" placeholder="Search.." name="search">
                   <button type="submit">Search</button>
                </form>
            </div>
            <div id="Login">
              
                <a href="#modal" class="LoginLink">Login</a>

               
               ||
               <a id="Authorization" href="SignUpPage.html" > 
                   Sign-Up
               </a>
            </div>
        </div>
        <div id="Categories">
            <div class="cat_button"> Category1</div>
            <div class="cat_button"> Category2</div>
            <div class="cat_button"> Category3</div>
            <div class="cat_button"> Category4</div>
            <div class="cat_button"> Category5</div>
        </div>
       
        <div class="modal_container" id="modal">
            <div class="modal">
                <a href="#" class="close">X</a>
                <span class="modal_heading">
                    Login
                </span>
                <form action="#">
                    Username or Email<br>
                    <input type="text" placeholder="Username/Email" ><br>
                    Password<br>
                    <input type="password" placeholder="Password"><br>
                    <input type="submit" class="btnRegister" value="Login">
                </form>
                <a href="#" class="signin">
                   Don't have an account yet?
                </a>
                <a href="#" class="forgotPassword">
                    Forgot Password?
                </a>
            </div>
</div>
    </body>
</html>

