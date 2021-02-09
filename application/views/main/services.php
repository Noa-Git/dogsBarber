</head>
<body>
<main>
    <br><br> <br>
    
   

    <h1 style="text-align: center;float:center"><b>השירותים שלנו</b></h1>
    <br><br>


    <div class="container-fluid">
        <div class="flip-box">
            <img src="<?php echo base_url('assets/Pictures/dog-haircut.jpg'); ?>" class="ser_img">
            <div class="overlay text-center">
                <br>
                <h1 class="" hero-text""><b>תספורת</b></h1>
                <br>
                <p id="text1">
                    תספורת מתאימה לגזע הכלב, רחצה, בישום, ויבוש</p>
                <a class="btn btn-primary" href="/orders/add">הזמן עכשיו</a>
            </div>

        </div>
        <div class="flip-box">
            <img src="<?php echo base_url('assets/Pictures/dog-spa.jpg'); ?>" class="ser_img">
            <div class="overlay text-center">
                <br>
                <h1><b>גרומינג</b></h1>
                <br>
                <p id="text1">
                    הברשה יסודית ופתיחת קשרים, דילול פרווה עודפת, רחצה, בישום וייבוש
                </p>
                <a class="btn btn-primary" href="/orders/add">הזמן עכשיו</a>
            </div>
        </div>

        <div class="flip-box">
            <img src="<?php echo base_url('assets/Pictures/bath.jpg'); ?>" class="ser_img">
            <div class="overlay text-center">
                <br>
                <h1><b>שטיפה בלבד</b></h1>
                <br>
                <p id="text1">
                    שטיפה עם שמפו, מרכך ובישום</p>
                <a class="btn btn-primary" href="/orders/add">הזמן עכשיו</a>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>

    <div class="container">
        <h2 class="section">המיוחדים שלנו</h2>
        <p class="section" id="text1">הספרים שלנו מתמחים גם בתספורות לכלבים גזעיים כמו פומרניין,שיצו וצ׳או צ׳או </p>
        <br>
    </div>

    <div class="container slideshow" style="max-width:800px">
        <img class="mySlides" src="<?php echo base_url('assets/Pictures/shizu.png'); ?>" style="width:100%">
        <img class="mySlides" src="<?php echo base_url('assets/Pictures/pom.png'); ?>" style="width:100%; display: none;">
        <img class="mySlides" src="<?php echo base_url('assets/Pictures/chau.png'); ?>" style="width:100%; display: none;">
        
        
    </div>
    
    <div class="container">
        <div class="section">
            <button class="button prev" onclick="plusDivs(-1)">❮ Prev</button>
            <button class="button next" onclick="plusDivs(1)">Next ❯</button>
        </div>
    </div>
    <br><br> 
    
</main>
    
    <script>
    var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
 
  x[slideIndex-1].style.display = "block";  
  
}

    </script>