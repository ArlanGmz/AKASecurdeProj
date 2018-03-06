<%-- 
    Document   : header
    Created on : Feb 27, 2018, 8:04:21 PM
    Author     : Alysa
--%>
<%@ page import="java.sql.*" %> 
<%@ page import="java.io.*" %> 


        <div id = "header">
            <div id="website_name">
                <a id="website_link" href="index.jsp" > 
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
            <a href="product.jsp"><div class="cat_button"> Wearables</div></a>
            <div class="cat_button"> Party Stuff</div>
            <div class="cat_button"> Toys</div>
            <div class="cat_button"> Craft Tools</div>
            <div class="cat_button"> Lifestyle</div>
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