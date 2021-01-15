</head>
 <body>
<main id="mainWrraper">

<h2>Register</h2>

<div id="info"><?php 
    if ($info!=null)
    {
        if ($info['code']=='0')
         {
            echo "Can not register user.  error: ".$info['message'];
        }
        else{
            echo $info['message'];
        }
     }
     ?>
</div>

<?php echo form_open('Customers/save_customer'); ?>

 
    <label>First Name</label>
    <input type="text" name="fname" required /><br>
     <label>Last Name</label>
    <input type="text" name="lname" required /><br>
     <label>Email</label>
    <input type="text" name="email" required /><br>
     <label>Phone Number</label>
    <input type="text" name="phone" required /><br>
    <label>Password</label>
    <input type="password" name="password"  required/><br>
   <label>Confirm Password</label>
    <input type="password" name="confirmPassword"  required/><br>
    <input class="createForm" type="submit" name="submit" value="register"/>
    <input id="Cancel" class="createForm" type="button" name="submit" value="Cancel" />
<?php echo form_close(); ?>

</main>
<script>
            document.getElementById("Cancel").onclick=function()
            {
                window.location.href="<?php echo site_url('Customers/login');?>";   
            };
 </script>

</body>
</html>