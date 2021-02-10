
	</head>
	<body>
	<header>
            
             <div class="container-fluid center" id="test">
        <br>
        <h1 class="logo"><b>Dog Barber</b></h1>
          <h3 class="logo"><b>מספרת הכלבים של ישראל</b></h3>
         
        <div class="container center">
        <nav class="navbar navbar-expand-sm center fs-3" dir="rtl">
            <ul class="nav navbar-nav mx-auto">
                <li class="nav-item li-style">
                  <a class="page-link" href="/main">דף הבית</a>
                </li>
                <li class="nav-item li-style">
                    <a class="page-link" href="/main/gallery">גלריה</a>
                </li>
                <li class="nav-item li-style">
                    <a class="page-link" href="/main/services">השירותים שלנו</a>
                </li>
                <li class="nav-item li-style">
                    <a class="page-link" href="/orders/add">הזמנות</a>
                </li>
                <li class="nav-item li-style">
                    <a class="page-link" href="/main/blog">בלוג</a>
                </li>
				<li class="nav-item li-style">
					<a class="page-link" href="/Statistics/show_stat">סטטיסטיקות</a>
				</li>
                <li class="nav-item li-style">
                    <a class="page-link" href="<?php echo base_url();?>customers/details">הפרופיל שלי</a>
                </li>
                 <li class="nav-item li-style">
                   
                        <?php 
                       
                        if(isset($_SESSION['loggedin'])){
                          echo  '<a class="page-link" href="'.base_url().'Customers/logout">התנתק</a>';  
                        }
                        else {
                          echo  '<a class="page-link" href="'.base_url().'Customers/login">התחבר</a>';  
                        }
                        ?>
                </li>
            </ul>
        </nav>
    </div> 
         <br><br><br><br><br>
          <hr class="rounded">
    </div>

	</header>




